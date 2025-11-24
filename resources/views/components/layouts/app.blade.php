<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Shop | Minimal E-commerce</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

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
                    }
                }
            }
        }
    </script>
    <style>

    </style>
</head>

<body class="bg-gray-50 text-gray-800 font-sans" x-data="{ 
    cartCount: 0, 
    mobileMenuOpen: false,
    addToCart() {
        this.cartCount++;
    }
}">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                <div class="flex items-center">
                    <a href="" class="text-2xl font-bold text-primary flex items-center gap-2">
                        <i class="ph-fill ph-shopping-bag"></i>
                        Kina
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{route('home')}}" class="text-gray-600 hover:text-primary transition font-medium">Home</a>
                    <a href="{{route('user.products')}}" class="text-gray-600 hover:text-primary transition font-medium">Shop</a>

                </div>

                <div class="flex items-center gap-2 sm:gap-4">


                    <button class="relative p-2 text-gray-600 hover:text-primary transition rounded-full hover:bg-gray-100">
                        <a href="{{route('cart.index')}}"> <i class="ph ph-shopping-cart text-2xl"></i></a>


                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-500 rounded-full">
                            {{Auth::check() ? (Auth::user()->cart?->cartItems()->count() ?? 0) : 0}}
                        </span>
                    </button>


                    @if(Auth::check())
                    <!-- User dropdown -->
                    <div class="relative group">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Hello, {{Str::of(Auth::user()->name)->before(' ')}}</span>
                            <button class="text-gray-600 hover:text-gray-900 focus:outline-none">
                                <a href="#" class="p-2 text-gray-600 hover:text-primary transition rounded-full hover:bg-gray-100">
                                    <i class="ph ph-user text-2xl"></i>
                                </a>
                            </button>
                        </div>

                        <!-- Dropdown menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="{{route('profile')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="{{route('order.index')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Orders</a>
                            <div class="border-t border-gray-100"></div>
                            <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
                        </div>
                    </div>

                    @else
                    <div class="relative group">
                        <div class="flex items-center space-x-2">

                            <button class="text-gray-600 hover:text-gray-900 focus:outline-none">
                                <a href="#" class="p-2 text-gray-600 hover:text-primary transition rounded-full hover:bg-gray-100">
                                    <i class="ph ph-user text-2xl"></i>
                                </a>
                            </button>
                        </div>

                        <!-- Dropdown menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">

                            <div class="border-t border-gray-100"></div>
                            <a href="{{route('login.show')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                        </div>
                    </div>

                    @endif

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-gray-600 hover:text-primary focus:outline-none">
                        <i class="ph ph-list text-2xl" x-show="!mobileMenuOpen"></i>
                        <i class="ph ph-x text-2xl" x-show="mobileMenuOpen" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="md:hidden bg-white border-t border-gray-100 absolute w-full shadow-lg">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md">Home</a>
                <a href="#shop" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md">Shop</a>
                <a href="#categories" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md">Categories</a>
                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-primary hover:bg-gray-50 rounded-md">Contact</a>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- FOOTER -->
    <footer class="bg-green-900 text-white py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Column 1 -->
                <div class="mb-4">
                    <h3 class="text-2xl font-bold mb-4 flex items-center gap-2">
                        <i class="ph-fill ph-shopping-bag text-primary"></i>
                        Kina
                    </h3>
                    <p class="text-gray-400 text-sm">Making premium fashion accessible to everyone. Designed for comfort and style.</p>
                </div>
                <!-- Column 2 -->
                <div>
                    <h4 class="font-bold text-lg mb-4">Shop</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition">New Arrivals</a></li>
                        <li><a href="#" class="hover:text-white transition">Best Sellers</a></li>
                        <li><a href="#" class="hover:text-white transition">Accessories</a></li>
                        <li><a href="#" class="hover:text-white transition">Sale</a></li>
                    </ul>
                </div>
                <!-- Column 3 -->
                <div>
                    <h4 class="font-bold text-lg mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Shipping Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Returns & Exchanges</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>
                <!-- Column 4 -->
                <div>
                    <h4 class="font-bold text-lg mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i class="ph-fill ph-facebook-logo"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i class="ph-fill ph-instagram-logo"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i class="ph-fill ph-twitter-logo"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500 text-sm">
                &copy; 2025 Kina. All rights reserved.
            </div>
        </div>
    </footer>

</body>

</html>