<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">


    <header class="bg-white shadow-sm">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="text-xl font-bold text-gray-900">Firefly-Store</div>
            <div class="flex items-center space-x-8">
                <a href="{{route('home')}}" class="text-gray-600 hover:text-gray-900">Home</a>
                <a href="{{route('products.index')}}" class="text-gray-900 font-medium">Products</a>
                <div class="flex items-center space-x-4">

                    <a href="{{route('cart.index')}}" class="relative text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="absolute -top-2 -right-2 bg-gray-900 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ Auth::check() ? (Auth::user()->cart?->cartItems()->count() ?? 0) : 0 }}</span>
                    </a>

                    <a href="#" class="text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Checkout Content -->
    <main class="max-w-7xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>

        <form action="" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Checkout Form -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Shipping Address -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Shipping Address</h2>

                        <!-- Address Selector -->
                        @if(isset($addresses) && count($addresses) > 0)
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select Saved Address</label>
                            <select onchange="window.location.href='?address_id='+this.value" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900">
                                <option value="">-- Choose an address or fill manually --</option>
                                @foreach($addresses as $address)
                                <option value="{{$address->id}}" @if(request('address_id')==$address->id) selected @endif>
                                    {{$address->street_address_1}}@if($address->street_address_2), {{$address->street_address_2}}@endif, {{$address->city}}, {{$address->state}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="name" id="name" value="{{auth()->user()->name}}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900" placeholder="John Doe" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Street Address 1</label>
                                <input type="text" name="street_address_1" id="street_address_1" value="{{$selectedAddress->street_address_1 ?? ''}}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900" placeholder="123 Main Street" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Street Address 2 (Optional)</label>
                                <input type="text" name="street_address_2" id="street_address_2" value="{{$selectedAddress->street_address_2 ?? ''}}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900" placeholder="Apartment, suite, etc.">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                <input type="text" name="city" id="city" value="{{$selectedAddress->city ?? ''}}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900" placeholder="Pokhara" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                                <input type="text" name="state" id="state" value="{{$selectedAddress->state ?? ''}}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900" placeholder="Bagmati" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                                <input type="text" name="country" id="country" value="{{$selectedAddress->country ?? ''}}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900" placeholder="Nepal" required>
                            </div>
                        </div>
                    </div>


                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Payment Method</h2>

                        <div class="space-y-3">
                            <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="esewa" class="w-4 h-4 text-gray-900" checked>
                                <span class="ml-3 flex items-center gap-3">
                                    <div class="w-8 h-8 bg-green-600 rounded flex items-center justify-center text-white font-bold text-xs">E</div>
                                    <span class="font-medium">eSewa</span>
                                </span>
                            </label>
                            <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="cod" class="w-4 h-4 text-gray-900">
                                <span class="ml-3 flex items-center gap-2">
                                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span class="font-medium">Cash on Delivery</span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow p-6 sticky top-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Summary</h2>

                        <div class="space-y-3 mb-4">
                            @foreach($cartItems as $item)
                            <div class="flex items-center gap-3 py-2 border-b">
                                <div class="w-16 h-16 bg-gray-200 rounded flex-shrink-0">
                                    <img src="/storage/{{$item->product->image}}" alt="{{$item->product->name}}" class="w-full h-full object-cover rounded">
                                </div>
                                <div class="flex-grow">
                                    <p class="text-sm font-medium text-gray-900">{{$item->product->name}}</p>
                                    <p class="text-xs text-gray-600">Qty: {{$item->quantity}}</p>
                                </div>
                                <p class="text-sm font-semibold">Rs {{$item->product->price * $item->quantity}}</p>
                            </div>
                            @endforeach
                        </div>

                        <div class="space-y-2 mb-4 pt-4">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>Rs {{$subtotal}}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span>Rs {{$shipping}}</span>
                            </div>
                            <div class="border-t pt-3 flex justify-between text-lg font-bold text-gray-900">
                                <span>Total</span>
                                <span>Rs {{$total}}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 mb-3">
                            Place Order
                        </button>
                        <a href="{{route('cart.index')}}" class="block w-full px-6 py-3 bg-gray-200 text-gray-900 text-center rounded-lg hover:bg-gray-300">
                            Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </main>

</body>

</html>