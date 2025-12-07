@extends('components.layouts.app')

@section('content')

<section class="bg-secondary/30 border-b border-purple-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4">
            <a href="{{route('cart.index')}}" class="p-2 rounded-full bg-white border border-gray-200 text-gray-600 hover:text-primary hover:border-primary transition">
                <i class="ph-bold ph-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
                <p class="text-gray-600 mt-1">Complete your purchase</p>
            </div>
        </div>
    </div>
</section>

<main class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <form action="{{route('checkout.store')}}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left Column: Forms -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Shipping Address -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-primary">
                                <i class="ph-fill ph-map-pin text-xl"></i>
                            </div>
                            <h2 class="text-lg font-bold text-gray-900">Shipping Address</h2>
                        </div>

                        @if(isset($addresses) && count($addresses) > 0)
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Saved Addresses</label>
                            <div class="grid grid-cols-1 gap-3">
                                @foreach($addresses as $address)
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="selected_address_id" value="{{$address->id}}"
                                        onclick="window.location.href='?address_id={{$address->id}}'"
                                        class="peer sr-only"
                                        @if(request('address_id')==$address->id) checked @endif>
                                    <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-primary peer-checked:bg-purple-50 hover:border-gray-300 transition">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <span class="block font-bold text-gray-900">{{$address->street_address_1}}</span>
                                                <span class="block text-sm text-gray-500">{{$address->city}}, {{$address->state}}, {{$address->country}}</span>
                                            </div>
                                            <i class="ph-fill ph-check-circle text-primary text-xl opacity-0 peer-checked:opacity-100"></i>
                                        </div>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="relative flex py-3 items-center mb-6">
                            <div class="flex-grow border-t border-gray-200"></div>
                            <span class="flex-shrink mx-4 text-gray-400 text-sm">Or enter new address</span>
                            <div class="flex-grow border-t border-gray-200"></div>
                        </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="name" value="{{auth()->user()->name}}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                    required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Street Address 1</label>
                                <input type="text" name="street_address_1" value="{{$selectedAddress->street_address_1 ?? ''}}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                    required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Street Address 2 (Optional)</label>
                                <input type="text" name="street_address_2" value="{{$selectedAddress->street_address_2 ?? ''}}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                <input type="text" name="city" value="{{$selectedAddress->city ?? ''}}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                    required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                                <input type="text" name="state" value="{{$selectedAddress->state ?? ''}}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                    required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                                <input type="text" name="country" value="{{$selectedAddress->country ?? ''}}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-primary">
                                <i class="ph-fill ph-credit-card text-xl"></i>
                            </div>
                            <h2 class="text-lg font-bold text-gray-900">Payment Method</h2>
                        </div>

                        <div class="space-y-3">
                            <label class="relative cursor-pointer block">
                                <input type="radio" name="payment_method" value="esewa" class="peer sr-only" checked>
                                <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-primary peer-checked:bg-purple-50 flex items-center justify-between transition">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-[#60bb46] rounded-lg flex items-center justify-center text-white font-bold text-xs">
                                            eSewa
                                        </div>
                                        <div>
                                            <span class="block font-bold text-gray-900">Pay with eSewa</span>
                                            <span class="block text-xs text-gray-500">Digital Wallet</span>
                                        </div>
                                    </div>
                                    <i class="ph-fill ph-check-circle text-primary text-xl opacity-0 peer-checked:opacity-100"></i>
                                </div>
                            </label>

                            <label class="relative cursor-pointer block">
                                <input type="radio" name="payment_method" value="cod" class="peer sr-only">
                                <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-primary peer-checked:bg-purple-50 flex items-center justify-between transition">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gray-800 rounded-lg flex items-center justify-center text-white">
                                            <i class="ph-fill ph-money text-2xl"></i>
                                        </div>
                                        <div>
                                            <span class="block font-bold text-gray-900">Cash on Delivery</span>
                                            <span class="block text-xs text-gray-500">Pay when you receive</span>
                                        </div>
                                    </div>
                                    <i class="ph-fill ph-check-circle text-primary text-xl opacity-0 peer-checked:opacity-100"></i>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24 space-y-6">
                        
                        <!-- Coupon Section -->
                        <div>
                            <div class="flex items-center gap-2 mb-4">
                                <i class="ph-fill ph-ticket text-primary text-lg"></i>
                                <h3 class="font-bold text-gray-900">Coupon Code</h3>
                            </div>

                            @if(session('success'))
                            <div class="mb-3 bg-green-50 border border-green-200 rounded-lg p-2 flex items-center gap-2">
                                <i class="ph-fill ph-check-circle text-green-500 text-sm"></i>
                                <p class="text-green-800 text-xs font-medium">{{ session('success') }}</p>
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="mb-3 bg-red-50 border border-red-200 rounded-lg p-2 flex items-center gap-2">
                                <i class="ph-fill ph-warning-circle text-red-500 text-sm"></i>
                                <p class="text-red-800 text-xs font-medium">{{ session('error') }}</p>
                            </div>
                            @endif

                            @if(session('applied_coupon'))
                            <div class="bg-green-50 border border-green-200 rounded-lg p-3 flex justify-between items-center">
                                <div class="flex items-center gap-2">
                                    <i class="ph-fill ph-check-circle text-green-500"></i>
                                    <div>
                                        <span class="font-bold text-green-800 text-sm">{{ session('applied_coupon.code') }}</span>
                                        <p class="text-green-600 text-xs">-Rs {{ number_format(session('applied_coupon.discount'), 2) }}</p>
                                    </div>
                                </div>
                                <button type="button" onclick="event.preventDefault(); var form = document.createElement('form'); form.method = 'POST'; form.action = '{{ route('checkout.remove-coupon') }}'; var csrf = document.createElement('input'); csrf.type = 'hidden'; csrf.name = '_token'; csrf.value = '{{ csrf_token() }}'; form.appendChild(csrf); document.body.appendChild(form); form.submit();" class="text-red-600 hover:text-red-800 p-1">
                                    <i class="ph-bold ph-x text-lg"></i>
                                </button>
                            </div>
                            @else
                            <div class="flex gap-2">
                                <input type="text" name="coupon_code" value="{{ old('coupon_code') }}"
                                    class="flex-1 px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                                    placeholder="Enter code">
                                <button type="button" onclick="event.preventDefault(); var form = document.createElement('form'); form.method = 'POST'; form.action = '{{ route('checkout.apply-coupon') }}'; var csrf = document.createElement('input'); csrf.type = 'hidden'; csrf.name = '_token'; csrf.value = '{{ csrf_token() }}'; form.appendChild(csrf); var input = document.createElement('input'); input.type = 'hidden'; input.name = 'coupon_code'; input.value = this.previousElementSibling.value; form.appendChild(input); document.body.appendChild(form); form.submit();"
                                    class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-purple-700 transition whitespace-nowrap">
                                    Apply
                                </button>
                            </div>
                            @endif
                        </div>

                        <div class="border-t border-gray-100 pt-6">
                            <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center justify-between">
                                Order Summary
                                <span class="text-xs font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded-md">{{ count($cartItems) }} items</span>
                            </h2>

                            <div class="space-y-3 mb-4 max-h-48 overflow-y-auto">
                                @foreach($cartItems as $item)
                                <div class="flex gap-3 items-start">
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex-shrink-0 overflow-hidden border border-gray-200">
                                        <img src="/storage/{{$item->product->image}}" alt="{{$item->product->name}}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-bold text-gray-900 truncate">{{$item->product->name}}</p>
                                        <p class="text-xs text-gray-500">Qty: {{$item->quantity}}</p>
                                    </div>
                                    <p class="text-sm font-bold text-gray-900">Rs {{$item->product->price * $item->quantity}}</p>
                                </div>
                                @endforeach
                            </div>

                            <div class="border-t border-gray-100 pt-4 space-y-2 mb-4">
                                <div class="flex justify-between text-gray-600 text-sm">
                                    <span>Subtotal</span>
                                    <span class="font-medium">Rs {{$subtotal}}</span>
                                </div>

                                @if(session('applied_coupon'))
                                <div class="flex justify-between text-green-600 text-sm">
                                    <span>Discount</span>
                                    <span class="font-medium">- Rs {{ number_format(session('applied_coupon.discount'), 2) }}</span>
                                </div>
                                @endif

                                <div class="flex justify-between text-gray-600 text-sm">
                                    <span>Shipping</span>
                                    <span class="font-medium">Rs {{$shipping}}</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mb-6 pb-6 border-b border-gray-100">
                                <span class="font-bold text-gray-900">Total</span>
                                <span class="text-2xl font-bold text-primary">Rs {{ number_format($total, 2) }}</span>
                            </div>

                            <button type="submit" class="w-full py-4 bg-primary text-white rounded-xl font-bold shadow-lg hover:bg-purple-700 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <span>Place Order</span>
                                <i class="ph-bold ph-arrow-right"></i>
                            </button>

                            <p class="text-xs text-gray-500 text-center mt-4">
                                <i class="ph-fill ph-shield-check text-primary"></i>
                                Secure checkout
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

@endsection