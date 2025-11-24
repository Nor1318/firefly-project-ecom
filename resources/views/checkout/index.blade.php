<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Kina</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#266e1cff',
                        secondary: '#0a2005ff',
                        surface: '#f8f9fa',
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom Radio Button Styling */
        input[type="radio"]:checked+div {
            border-color: #266e1cff;
            background-color: #f0fdf4;
            box-shadow: 0 4px 6px -1px rgba(38, 110, 28, 0.1);
        }

        input[type="radio"]:checked+div .check-icon {
            opacity: 1;
            transform: scale(1);
        }
    </style>
</head>

<body class="bg-gray-50 font-sans antialiased text-gray-800">

    <!-- HEADER -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-primary flex items-center gap-2 tracking-tight">
                        <i class="ph-fill ph-shopping-bag"></i>
                        Kina
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{route('home')}}" class="text-sm font-medium text-gray-500 hover:text-primary transition">Home</a>
                    <a href="{{route('products.index')}}" class="text-sm font-medium text-gray-500 hover:text-primary transition">Shop</a>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{route('cart.index')}}" class="relative group p-2 rounded-full hover:bg-gray-50 transition text-gray-600 hover:text-primary">
                        <i class="ph-bold ph-shopping-cart text-xl"></i>
                        <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white border-2 border-white">
                            {{ Auth::check() ? (Auth::user()->cart?->cartItems()->count() ?? 0) : 0 }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center gap-3 mb-8">
            <a href="{{route('cart.index')}}" class="p-2 rounded-full bg-white border border-gray-200 text-gray-500 hover:text-primary hover:border-primary transition">
                <i class="ph-bold ph-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
        </div>

        <form action="" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

                <!-- LEFT COLUMN: Forms -->
                <div class="lg:col-span-8 space-y-8">

                    <!-- 1. ADDRESS SELECTION -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-primary">
                                <i class="ph-fill ph-map-pin text-xl"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Shipping Address</h2>
                        </div>

                        <!-- Saved Addresses (Radio Buttons) -->
                        @if(isset($addresses) && count($addresses) > 0)
                        <div class="mb-8">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide mb-4">Select from saved addresses</label>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($addresses as $address)
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="selected_address_id" value="{{$address->id}}"
                                        onclick="window.location.href='?address_id={{$address->id}}'"
                                        class="peer sr-only"
                                        @if(request('address_id')==$address->id) checked @endif>

                                    <div class="p-4 rounded-xl border-2 border-gray-200 hover:border-gray-300 transition-all duration-200 h-full">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <span class="block font-bold text-gray-900 mb-1">{{$address->street_address_1}}</span>
                                                <span class="block text-sm text-gray-500">{{$address->city}}, {{$address->state}}</span>
                                                <span class="block text-sm text-gray-500">{{$address->country}}</span>
                                            </div>
                                            <div class="check-icon w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center opacity-0 transform scale-50 transition-all duration-200">
                                                <i class="ph-bold ph-check text-xs"></i>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="relative flex py-2 items-center mb-8">
                            <div class="flex-grow border-t border-gray-200"></div>
                            <span class="flex-shrink-0 mx-4 text-gray-400 text-sm">Or enter new details</span>
                            <div class="flex-grow border-t border-gray-200"></div>
                        </div>
                        @endif

                        <!-- Manual Address Form -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="name" id="name" value="{{auth()->user()->name}}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all font-medium" placeholder="John Doe" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Street Address 1</label>
                                <input type="text" name="street_address_1" id="street_address_1" value="{{$selectedAddress->street_address_1 ?? ''}}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="123 Main Street" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Street Address 2 (Optional)</label>
                                <input type="text" name="street_address_2" id="street_address_2" value="{{$selectedAddress->street_address_2 ?? ''}}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Apartment, suite, etc.">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                <input type="text" name="city" id="city" value="{{$selectedAddress->city ?? ''}}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Pokhara" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                                <input type="text" name="state" id="state" value="{{$selectedAddress->state ?? ''}}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Bagmati" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                                <input type="text" name="country" id="country" value="{{$selectedAddress->country ?? ''}}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" placeholder="Nepal" required>
                            </div>
                        </div>
                    </div>

                    <!-- 2. PAYMENT METHOD -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-primary">
                                <i class="ph-fill ph-credit-card text-xl"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Payment Method</h2>
                        </div>

                        <div class="space-y-4">
                            <!-- eSewa Option -->
                            <label class="relative cursor-pointer group block">
                                <input type="radio" name="payment_method" value="esewa" class="peer sr-only" checked>
                                <div class="p-4 rounded-xl border-2 border-gray-200 hover:border-gray-300 flex items-center justify-between transition-all">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-[#60bb46] rounded-lg flex items-center justify-center text-white font-bold shadow-sm">
                                            eSewa
                                        </div>
                                        <div>
                                            <span class="block font-bold text-gray-900">Pay with eSewa</span>
                                            <span class="block text-xs text-gray-500">Digital Wallet</span>
                                        </div>
                                    </div>
                                    <div class="check-icon w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center opacity-0 transform scale-50 transition-all">
                                        <i class="ph-bold ph-check text-xs"></i>
                                    </div>
                                </div>
                            </label>

                            <!-- COD Option -->
                            <label class="relative cursor-pointer group block">
                                <input type="radio" name="payment_method" value="cod" class="peer sr-only">
                                <div class="p-4 rounded-xl border-2 border-gray-200 hover:border-gray-300 flex items-center justify-between transition-all">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-gray-800 rounded-lg flex items-center justify-center text-white font-bold shadow-sm">
                                            <i class="ph-fill ph-money text-2xl"></i>
                                        </div>
                                        <div>
                                            <span class="block font-bold text-gray-900">Cash on Delivery</span>
                                            <span class="block text-xs text-gray-500">Pay when you receive</span>
                                        </div>
                                    </div>
                                    <div class="check-icon w-6 h-6 bg-primary text-white rounded-full flex items-center justify-center opacity-0 transform scale-50 transition-all">
                                        <i class="ph-bold ph-check text-xs"></i>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN: Order Summary -->
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 p-6 sticky top-24">
                        <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center justify-between">
                            Order Summary
                            <span class="text-xs font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded-md">{{ count($cartItems) }} items</span>
                        </h2>

                        <div class="space-y-4 mb-6 max-h-80 overflow-y-auto pr-2 custom-scrollbar">
                            @foreach($cartItems as $item)
                            <div class="flex gap-4 items-start">
                                <div class="w-14 h-14 bg-gray-100 rounded-lg flex-shrink-0 overflow-hidden border border-gray-200">
                                    <img src="/storage/{{$item->product->image}}" alt="{{$item->product->name}}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-grow">
                                    <p class="text-sm font-bold text-gray-900 line-clamp-1">{{$item->product->name}}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Qty: {{$item->quantity}}</p>
                                </div>
                                <p class="text-sm font-bold text-gray-900">Rs {{$item->product->price * $item->quantity}}</p>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t border-dashed border-gray-200 pt-4 space-y-3">
                            <div class="flex justify-between text-gray-600 text-sm">
                                <span>Subtotal</span>
                                <span class="font-medium">Rs {{$subtotal}}</span>
                            </div>
                            <div class="flex justify-between text-gray-600 text-sm">
                                <span>Shipping</span>
                                <span class="font-medium">Rs {{$shipping}}</span>
                            </div>
                            <div class="border-t border-gray-100 pt-3 flex justify-between items-end">
                                <span class="font-bold text-gray-900">Total</span>
                                <span class="text-2xl font-bold text-primary">Rs {{$total}}</span>
                            </div>
                        </div>

                        <div class="mt-8 space-y-3">
                            <button type="submit" class="w-full py-4 bg-primary text-white rounded-xl font-bold text-sm shadow-lg shadow-green-900/20 hover:bg-[#1e5616] transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <span>Place Order</span>
                                <i class="ph-bold ph-arrow-right"></i>
                            </button>


                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <!-- FOOTER (Minimal) -->
    <footer class="bg-white border-t border-gray-100 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-400 text-sm">&copy; 2025 Kina Store. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>