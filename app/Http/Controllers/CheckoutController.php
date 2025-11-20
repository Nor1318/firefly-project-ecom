<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Xentixar\EsewaSdk\Esewa;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Get cart items with products
        $cartItems = $cart->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $shipping = 100;
        $total = $subtotal + $shipping;
        $addresses = Address::where('user_id', Auth::id())->get();

        $selectedAddress = null;
        if (request('address_id')) {
            $selectedAddress = Address::where('user_id', Auth::id())
                ->where('id', request('address_id'))
                ->first();
        }

        return view("checkout.index", compact('cartItems', 'subtotal', 'shipping', 'total', 'addresses', 'selectedAddress'));
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'street_address_1' => 'required|string',
            'street_address_2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'payment_method' => 'required|in:esewa,khalti,cod',
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItems = $cart->cartItems()->with('product')->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $shipping = 100;
        $total = $subtotal + $shipping;

        $address = Address::firstOrCreate(
            [
                'user_id' => Auth::user()->id,
                'street_address_1' => $validated['street_address_1'],
                'street_address_2' => $validated['street_address_2'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'country' => $validated['country'],
            ]
        );

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'status' => 'pending',
            'address_id' => $address->id
        ]);


        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'amount_per_item' => $item->product->price,
            ]);
        }

        $cart->cartItems()->delete();


        if ($validated['payment_method'] === 'esewa') {
            $esewa = new Esewa();
            $callbackRoute = route('esewa.callback');
            $esewa->config($callbackRoute, $callbackRoute, $total, $order->id . "-MYSYSTEM");
            $esewa->init();
        } else {

            Payment::create([
                'order_id' => $order->id,
                'payment_method' => "Cash",
                'status' => 'pending',
            ]);

            return redirect()->route('order.index', $order->id);
        }
    }

    public function esewaCallback(Request $request)
    {
        $esewa = new Esewa();
        $data = $esewa->decode();

        if ($data) {
            if ($data['status'] == 'COMPLETE') {
                $paymentId = explode('-', $data['transaction_uuid'])[0];
                $payment = Payment::find($paymentId);
                if ($payment) {
                    $payment->update([
                        'status' => 'completed',
                        'transaction_code' => $data['transaction_code'],
                    ]);
                } else {
                    dd(1);
                }
            } else {
                $paymentId = explode('-', $data['transaction_uuid'])[0];
                $payment = Payment::find($paymentId);
                if ($payment) {
                    $payment->update([
                        'status' => 'failed'
                    ]);
                } else {
                    return redirect()->back();
                }
            }
        } else {
            return redirect()->route('order.index')->with("failedPayment", "Your Payment Failed");
        }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
