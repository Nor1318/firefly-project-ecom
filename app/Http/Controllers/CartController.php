<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    public function addToCart(Request $request, $product_id)
    {

        if (Auth::check()) {

            if (Auth::user()->role == 'admin') {
                return redirect()->back()->with('error', 'Admins cannot shop.');
            }

            $user = Auth::user();
            $product = Product::findOrFail($product_id);

            $qty = (int) $request->input('quantity', 1);


            $cart = Cart::firstOrCreate(['user_id' => $user->id]);

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product_id)
                ->first();

            $existingQtyInCart = $cartItem ? $cartItem->quantity : 0;

            if (($existingQtyInCart + $qty) > $product->quantity) {
                return redirect()->back()->with('error', 'Not enough items in stock. You already have ' . $existingQtyInCart . ' in your cart.');
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

            return redirect()->back()->with('success', 'Product added to the cart.');
        } else {
            return redirect()->route('login.show')->with('error', 'Please login to add items to cart.');
        }
    }



    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $orderCount = OrderItem::whereHas('order', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count();
            return view('cart.index', compact('user', 'orderCount'));
        }
        return redirect()->route('login.show');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $product_id)
    {

        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();
            $product = Product::find($product_id)->quantity;
            $inputName = 'quantity_' . $product_id;

            $request->validate([
                $inputName => 'required|numeric|min:1|max:' . $product
            ], [
                $inputName . '.max' => 'Only ' . $product . ' items left in stock.'
            ]);

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product_id)
                ->first();


            if ($cartItem) {
                if ($request->$inputName <= $product) {
                    $newQuantity = max(1, $request->$inputName);
                    $cartItem->quantity = $newQuantity;
                    $cartItem->save();
                } else {
                }
                return redirect()->back()->with('success', 'Cart updated successfully.');
            } else {
                return redirect()->route('login.show');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $product_id)
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

            return redirect()->back()->with('success', 'Product removed from cart.');
        } else {
            return redirect()->route('login.show');
        }
    }
}
