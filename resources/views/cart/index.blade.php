@extends('components/layouts.app')

@section('content')

<main class="py-12 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Your Shopping Cart</h1>
            <p class="text-gray-500 mt-2">Manage your items and proceed to checkout</p>
        </div>

        @php
        $total = 0;
        $shipping = 100;
        @endphp

        @if(Auth::user()->cart && Auth::user()->cart->cartItems->count() > 0)

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Cart Header (Hidden on mobile) -->
            <div class="hidden md:grid grid-cols-12 gap-4 p-6 bg-gray-50 border-b border-gray-200 text-sm font-semibold text-gray-600 uppercase tracking-wider">
                <div class="col-span-6">Product</div>
                <div class="col-span-3 text-center">Quantity</div>
                <div class="col-span-2 text-right">Total</div>
                <div class="col-span-1 text-center">Actions</div>
            </div>

            <div class="divide-y divide-gray-100">
                @foreach(Auth::user()->cart->cartItems as $cartItem)
                @php
                $lineTotal = $cartItem->product->price * $cartItem->quantity;
                $total += $lineTotal;
                @endphp

                <!-- Cart Item Row -->
                <div class="p-6 grid grid-cols-1 md:grid-cols-12 gap-6 items-center group hover:bg-gray-50/50 transition-colors">

                    <!-- Product Info -->
                    <div class="col-span-1 md:col-span-6 flex items-center gap-6">
                        <div class="w-20 h-20 md:w-24 md:h-24 bg-gray-100 rounded-xl flex-shrink-0 overflow-hidden border border-gray-200">
                            <img src="/storage/{{$cartItem->product->image}}" alt="{{$cartItem->product->name}}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{$cartItem->product->name}}</h3>
                            <p class="text-gray-500 text-sm mb-1 line-clamp-1">{{$cartItem->product->description}}</p>
                            <p class="text-sm font-medium text-gray-500">Unit Price: Rs {{$cartItem->product->price}}</p>
                        </div>
                    </div>

                    <div class="col-span-1 md:col-span-3 flex flex-col items-center justify-center">
                        <form action="{{ route('cart.update', $cartItem->product->id) }}" method="POST" class="flex flex-col items-center gap-2">
                            @csrf
                            @method('PUT')

                            <div class="flex items-center border border-gray-300 rounded-lg bg-white overflow-hidden">
                                <button type="button" onclick="this.nextElementSibling.stepDown()" class="px-3 py-2 text-gray-600 hover:bg-gray-100">
                                    <i class="ph-bold ph-minus"></i>
                                </button>

                                <!-- Input -->
                                <input
                                    type="number"
                                    name="quantity_{{$cartItem->product->id}}"
                                    value="{{ $cartItem->quantity }}"
                                    min="1"

                                    class="w-12 text-center border-x border-gray-300 py-2 text-gray-900 font-semibold focus:outline-none appearance-none">
                                <button type="button" onclick="this.previousElementSibling.stepUp()" class="px-3 py-2 text-gray-600 hover:bg-gray-100">
                                    <i class="ph-bold ph-plus"></i>
                                </button>
                            </div>

                            <!-- Update Button -->
                            <button type="submit" class="text-xs font-semibold text-primary hover:text-green-800 underline decoration-transparent hover:decoration-primary transition-all">
                                Update
                            </button>

                            @error('quantity_'.$cartItem->product->id)
                            <div class="text-red-500 text-xs">{{$message}}</div>
                            @enderror
                        </form>

                    </div>
                    <!-- Price Calculation -->
                    <div class="col-span-1 md:col-span-2 flex items-center justify-between md:justify-end">
                        <span class="md:hidden text-gray-500 font-medium">Total:</span>
                        <p class="text-lg font-bold text-gray-900">Rs {{$lineTotal}}</p>
                    </div>

                    <!-- Remove Button -->
                    <div class="col-span-1 md:col-span-1 flex justify-end md:justify-center">
                        <form method="post" action="{{route('cart.destroy', $cartItem->product->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="text-gray-400 hover:text-red-600 p-2 rounded-full hover:bg-red-50 transition-all" title="Remove Item">
                                <i class="ph-duotone ph-trash text-2xl"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Bottom Summary Bar -->
            <div class="bg-gray-50 p-6 md:p-8 border-t border-gray-200">
                <div class="flex flex-col md:flex-row justify-end items-center gap-8 md:gap-12">
                    <div class="w-full md:w-auto flex flex-col sm:flex-row gap-4">
                        <a href="{{route('user.products')}}" class="px-8 py-3 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-white hover:border-gray-400 transition text-center">
                            Continue Shopping
                        </a>
                        <a href="{{route('checkout.index')}}" class="px-8 py-3 rounded-xl bg-primary text-white font-bold shadow-lg shadow-green-900/20 hover:bg-green-800 transform hover:-translate-y-0.5 transition text-center flex items-center justify-center gap-2">
                            Checkout <i class="ph-bold ph-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @else
        <!-- Empty Cart State -->
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-200">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-gray-50 mb-6 text-gray-300">
                <i class="ph-duotone ph-shopping-bag text-5xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Your cart is currently empty</h2>
            <p class="text-gray-500 mb-8 max-w-md mx-auto">Looks like you haven't added any items to your cart yet. Browse our products to find something you love.</p>
            <a href="{{route('user.products')}}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-white bg-primary hover:bg-green-800 transition shadow-md">
                Start Shopping
            </a>
        </div>
        @endif
    </div>
</main>

@endsection