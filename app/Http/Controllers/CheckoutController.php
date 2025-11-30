<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $discount = 0;

        // Apply coupon discount if exists in session
        if (session('applied_coupon')) {
            $discount = session('applied_coupon.discount');
        }

        $total = $subtotal + $shipping - $discount;
        
        $addresses = Address::where('user_id', Auth::id())->get();

        $selectedAddress = null;
        if (request('address_id')) {
            $selectedAddress = Address::where('user_id', Auth::id())
                ->where('id', request('address_id'))
                ->first();
        }

        return view("checkout.index", compact('cartItems', 'subtotal', 'shipping', 'total', 'discount', 'addresses', 'selectedAddress'));
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
   

 public function esewaCallback(Request $request)
{
    $esewa = new Esewa();
    $data = $esewa->decode();

    if (!$data) {
        return redirect()->route('cart.index')->with("error", "Invalid Payment Request");
    }

    // FIX: Extract order ID from the new UUID format
    $uuidParts = explode('-', $data['transaction_uuid']);
    $orderId = $uuidParts[1]; // Get the order ID from the UUID

    $order = Order::find($orderId);
    $payment = Payment::where('order_id', $orderId)->first();

    if (!$order || !$payment) {
        return redirect()->route('home')->with('error', 'Order not found.');
    }

    if ($data['status'] === 'COMPLETE') {
        $payment->update([
            'status' => 'paid',
            'transaction_code' => $data['transaction_code'] ?? null,
        ]);

        $order->update(['status' => 'confirmed']);
        
       
        session()->forget('applied_coupon');
        
        Mail::to($order->user->email)->send(new OrderMail($order));

        return redirect()->route('order.index')->with('success', 'Payment Successful! Order placed.');
    } else {
        $payment->update([
            'status' => 'failed'
        ]);

        return redirect()->route('order.index')->with('error', 'Payment Failed. Please try again.');
    }
}
  public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string'
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();
        $cartItems = $cart->cartItems()->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
            return back()->with('error', 'Invalid coupon code');
        }

        if (!$coupon->isValid()) {
            return back()->with('error', 'This coupon is no longer valid');
        }

        $discount = $coupon->calculateDiscount($subtotal);

        if ($discount <= 0) {
            return back()->with('error', 'Coupon cannot be applied to this order');
        }

        // Store coupon in session
        session([
            'applied_coupon' => [
                'code' => $coupon->code,
                'discount' => $discount,
                'coupon_id' => $coupon->id
            ]
        ]);

        return back()->with('success', 'Coupon applied successfully!');
    }

    public function removeCoupon()
    {
        session()->forget('applied_coupon');
        return back()->with('success', 'Coupon removed successfully');
    }

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
    $discount = 0;
    $couponId = null;

    // Apply coupon discount if exists
    if (session('applied_coupon')) {
        $couponData = session('applied_coupon');
        $discount = $couponData['discount'];
        $couponId = $couponData['coupon_id'];
    }

    $total = $subtotal + $shipping - $discount;

    // Validate minimum amount for eSewa BEFORE creating order
    if ($validated['payment_method'] === 'esewa') {
        if ($total < 10) {
            return redirect()->back()->with('error', 'Minimum transaction amount for eSewa is Rs 10. Your total after discount is Rs ' . number_format($total, 2) . '. Please add more items or use Cash on Delivery.');
        }
        // Round to 2 decimal places for eSewa
        $total = round($total, 2);
    }

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
        'address_id' => $address->id,
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'discount' => $discount,
        'total' => $total,
        'coupon_id' => $couponId,
    ]);

    foreach ($cartItems as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'amount_per_item' => $item->product->price,
        ]);
        $item->product->decrement('quantity', $item->quantity);
    }

    // Increment coupon usage
    if ($couponId) {
        $coupon = Coupon::find($couponId);
        $coupon->incrementUsage();
    }

    $cart->cartItems()->delete();

    if ($validated['payment_method'] === 'esewa') {

        Payment::create([
            'order_id' => $order->id,
            'payment_method' => 'esewa',
            'status' => 'pending',
            'amount' => $total,
        ]);

        // FIX: Generate unique transaction UUID
        $transactionUuid = time() . '-' . $order->id . '-MYSYSTEM';
        
        $esewa = new Esewa();
        $callbackRoute = route('esewa.callback');
        $esewa->config($callbackRoute, $callbackRoute, $total, $transactionUuid);
        $esewa->init();
    } else {
        Payment::create([
            'order_id' => $order->id,
            'payment_method' => "Cash",
            'status' => 'pending',
        ]);

       
        session()->forget('applied_coupon');

        return redirect()->route('order.index', $order->id);
    }
}
}
