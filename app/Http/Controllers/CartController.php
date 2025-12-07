<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $product_id)
    {
        // Use database transaction with row locking to prevent race conditions
        return \DB::transaction(function () use ($request, $product_id) {
            // Lock the product row for update to prevent concurrent modifications
            $product = Product::where('id', $product_id)->lockForUpdate()->firstOrFail();
            $qty = (int) $request->input('quantity', 1);

            if (Auth::check()) {
                // Authenticated user - use database cart
                if (Auth::user()->role == 'admin') {
                    return redirect()->back()->with('error', 'Admins cannot shop.');
                }

                $user = Auth::user();
                $cart = Cart::firstOrCreate(['user_id' => $user->id]);

                // Lock cart item for update
                $cartItem = CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $product_id)
                    ->lockForUpdate()
                    ->first();

                $existingQtyInCart = $cartItem ? $cartItem->quantity : 0;

                // Validate total quantity doesn't exceed stock
                if (($existingQtyInCart + $qty) > $product->quantity) {
                    return redirect()->back()->with('error', 'Not enough items in stock. You already have ' . $existingQtyInCart . ' in your cart. Only ' . ($product->quantity - $existingQtyInCart) . ' more available.');
                }

                if ($cartItem) {
                    $cartItem->quantity += $qty;
                    $cartItem->save();
                } else {
                    CartItem::create([
                        'cart_id' => $cart->id,
                        'product_id' => $product_id,
                        'quantity' => $qty,
                    ]);
                }
            } else {
                // Guest user - use session cart
                $sessionCart = Session::get('cart', []);

                $existingQty = isset($sessionCart[$product_id]) ? $sessionCart[$product_id]['quantity'] : 0;

                // Validate total quantity doesn't exceed stock
                if (($existingQty + $qty) > $product->quantity) {
                    return redirect()->back()->with('error', 'Not enough items in stock. You already have ' . $existingQty . ' in your cart. Only ' . ($product->quantity - $existingQty) . ' more available.');
                }

                if (isset($sessionCart[$product_id])) {
                    $sessionCart[$product_id]['quantity'] += $qty;
                } else {
                    $sessionCart[$product_id] = [
                        'quantity' => $qty,
                        'product_id' => $product_id
                    ];
                }

                Session::put('cart', $sessionCart);
            }

            return redirect()->back()->with('success', 'Product added to the cart.');
        });
    }

    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cartItems = $user->cart ? $user->cart->cartItems : collect([]);
        } else {
            // Guest user - get cart from session
            $sessionCart = Session::get('cart', []);
            $cartItems = collect([]);
            
            foreach ($sessionCart as $productId => $item) {
                $product = Product::find($productId);
                if ($product) {
                    $cartItems->push((object)[
                        'product' => $product,
                        'quantity' => $item['quantity'],
                        'product_id' => $productId
                    ]);
                }
            }
        }

        return view('cart.index', compact('cartItems'));
    }

    public function update(Request $request, $product_id)
    {
        $product = Product::find($product_id);
        $inputName = 'quantity_' . $product_id;

        $request->validate([
            $inputName => 'required|numeric|min:1|max:' . $product->quantity
        ], [
            $inputName . '.max' => 'Only ' . $product->quantity . ' items left in stock.'
        ]);

        $newQuantity = max(1, $request->$inputName);

        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();

            if ($cart) {
                $cartItem = CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $product_id)
                    ->first();

                if ($cartItem) {
                    $cartItem->quantity = $newQuantity;
                    $cartItem->save();
                }
            }
        } else {
            // Guest user - update session cart
            $sessionCart = Session::get('cart', []);
            
            if (isset($sessionCart[$product_id])) {
                $sessionCart[$product_id]['quantity'] = $newQuantity;
                Session::put('cart', $sessionCart);
            }
        }

        return redirect()->back()->with('success', 'Cart updated successfully.');
    }

    public function destroy($product_id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();

            if ($cart) {
                $cartItem = CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $product_id)
                    ->first();

                if ($cartItem) {
                    $cartItem->delete();
                }
            }
        } else {
            // Guest user - remove from session cart
            $sessionCart = Session::get('cart', []);
            
            if (isset($sessionCart[$product_id])) {
                unset($sessionCart[$product_id]);
                Session::put('cart', $sessionCart);
            }
        }

        return redirect()->back()->with('success', 'Product removed from cart.');
    }

    /**
     * Merge session cart into user's database cart after login
     */
    public static function mergeSessionCart($user)
    {
        $sessionCart = Session::get('cart', []);
        
        if (empty($sessionCart)) {
            return;
        }

        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        foreach ($sessionCart as $productId => $item) {
            $product = Product::find($productId);
            
            if (!$product) {
                continue;
            }

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                // Merge quantities
                $newQuantity = min($cartItem->quantity + $item['quantity'], $product->quantity);
                $cartItem->quantity = $newQuantity;
                $cartItem->save();
            } else {
                // Add new item
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $productId,
                    'quantity' => min($item['quantity'], $product->quantity),
                ]);
            }
        }

        // Clear session cart
        Session::forget('cart');
    }
}
