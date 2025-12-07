@extends('components.layouts.app')

@section('content')

<section class="bg-secondary/30 border-b border-purple-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Shopping Cart</h1>
                <p class="text-gray-600 mt-1">Review your items before checkout</p>
            </div>
            <a href="{{route('user.products')}}" class="text-primary hover:text-purple-700 font-medium flex items-center gap-2">
                <i class="ph-bold ph-arrow-left"></i>
                Continue Shopping
            </a>
        </div>
    </div>
</section>

<main class="py-12 min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @php
        $total = 0;
        $shipping = 100;
        @endphp

        @if($cartItems->count() > 0)

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    
                    <div class="divide-y divide-gray-100">
                        @foreach($cartItems as $cartItem)
                        @php
                        $lineTotal = $cartItem->product->price * $cartItem->quantity;
                        $total += $lineTotal;
                        @endphp

                        <div class="p-6 hover:bg-purple-50/30 transition-colors">
                            <div class="flex gap-6">
                                
                                <!-- Product Image -->
                                <div class="w-24 h-24 bg-gray-100 rounded-xl flex-shrink-0 overflow-hidden border border-gray-200">
                                    <a href="{{ route('user.product.show', $cartItem->product->id) }}">
                                        <img src="/storage/{{$cartItem->product->image}}" alt="{{$cartItem->product->name}}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                    </a>
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <a href="{{ route('user.product.show', $cartItem->product->id) }}">
                                                <h3 class="font-bold text-gray-900 text-lg hover:text-primary transition">{{$cartItem->product->name}}</h3>
                                            </a>
                                            <p class="text-sm text-gray-500 mt-1">{{$cartItem->product->category->name}}</p>
                                        </div>
                                        <form method="post" action="{{route('cart.destroy', $cartItem->product_id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-gray-400 hover:text-red-600 p-2 rounded-lg hover:bg-red-50 transition-all" title="Remove">
                                                <i class="ph-bold ph-trash text-xl"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <!-- Quantity -->
                                        <form action="{{ route('cart.update', $cartItem->product_id) }}" method="POST" class="flex items-center gap-3">
                                            @csrf
                                            @method('PUT')

                                            <div class="flex items-center border-2 border-gray-200 rounded-lg bg-white">
                                                <button type="button" onclick="this.nextElementSibling.stepDown()" class="px-3 py-2 text-gray-600 hover:bg-gray-100 transition">
                                                    <i class="ph-bold ph-minus"></i>
                                                </button>
                                                <input
                                                    type="number"
                                                    name="quantity_{{$cartItem->product_id}}"
                                                    value="{{ $cartItem->quantity }}"
                                                    min="1"
                                                    max="{{ $cartItem->product->quantity }}"
                                                    class="w-16 text-center border-x-2 border-gray-200 py-2 text-gray-900 font-bold focus:outline-none">
                                                <button type="button" onclick="this.previousElementSibling.stepUp()" class="px-3 py-2 text-gray-600 hover:bg-gray-100 transition">
                                                    <i class="ph-bold ph-plus"></i>
                                                </button>
                                            </div>

                                            <button type="submit" class="text-sm font-medium text-primary hover:text-purple-700 transition">
                                                Update
                                            </button>
                                        </form>

                                        <!-- Price -->
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500">Rs {{$cartItem->product->price}} each</p>
                                            <p class="text-xl font-bold text-primary">Rs {{$lineTotal}}</p>
                                        </div>
                                    </div>

                                    @error('quantity_'.$cartItem->product_id)
                                    <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>

                    <div class="space-y-4 mb-6 pb-6 border-b border-gray-100">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{$cartItems->count()}} items)</span>
                            <span class="font-medium">Rs {{$total}}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="font-medium">Rs {{$shipping}}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-6">
                        <span class="text-lg font-bold text-gray-900">Total</span>
                        <span class="text-2xl font-bold text-primary">Rs {{$total + $shipping}}</span>
                    </div>

                    @if(Auth::check())
                        <a href="{{route('checkout.index')}}" class="w-full block text-center px-6 py-4 bg-primary text-white font-bold rounded-xl shadow-lg hover:bg-purple-700 transform hover:-translate-y-0.5 transition">
                            Proceed to Checkout
                        </a>
                    @else
                        <a href="{{route('login.show')}}" class="w-full block text-center px-6 py-4 bg-primary text-white font-bold rounded-xl shadow-lg hover:bg-purple-700 transform hover:-translate-y-0.5 transition">
                            Login to Checkout
                        </a>
                    @endif

                    <p class="text-xs text-gray-500 text-center mt-4">
                        <i class="ph-fill ph-shield-check text-primary"></i>
                        Secure checkout
                    </p>
                </div>
            </div>
        </div>

        @else
        <!-- Empty Cart State -->
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-purple-50 mb-6 text-primary">
                <i class="ph-duotone ph-shopping-bag text-5xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-8 max-w-md mx-auto">Looks like you haven't added any items yet. Start shopping to fill your cart!</p>
            <a href="{{route('user.products')}}" class="inline-flex items-center gap-2 px-8 py-3 bg-primary text-white font-bold rounded-full hover:bg-purple-700 transition shadow-md">
                <i class="ph-bold ph-shopping-cart"></i>
                Start Shopping
            </a>
        </div>
        @endif
    </div>
</main>

@endsection