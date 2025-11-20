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
        if (Auth::check() && Auth::user()->role != 'admin') {

            $user = Auth::user();

            $product = Product::findOrFail($product_id);

            $cart = Cart::firstOrCreate(['user_id' => $user->id]);

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product_id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product_id,
                    'quantity' => 1,
                ]);
            }

            if ($request->has('product_show')) {

                return redirect()->route('cart.index');
            }
            return redirect()->back()->with('success', 'Product added to the cart.');
        } else {
            return redirect()->route('login.show');
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

            $request->validate(
                [
                    'quantity' => 'min:1|max:' . $product,
                ]
            );

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product_id)
                ->first();

            if ($cartItem) {
                if ($request->quantity >= $product) {
                    $newQuantity = max(1, $request->quantity);
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
