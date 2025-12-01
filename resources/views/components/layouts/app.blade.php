<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kina | Kids Fashion Store</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        primary: '#9333EA', // Purple
                        secondary: '#F3E8FF', // Light Purple
                        accent: '#EC4899', // Pink
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-white text-gray-800 font-sans antialiased" x-data="{ 
    mobileMenuOpen: false,
    searchOpen: false
}">

    <!-- Header -->
    <nav class="bg-white sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{route('home')}}" class="flex items-center gap-2 group">
                        <span class="text-3xl font-bold text-primary tracking-tight group-hover:opacity-80 transition">Kina</span>
                        <span class="w-2 h-2 rounded-full bg-accent mt-2"></span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{route('home')}}" class="text-gray-600 hover:text-primary font-medium transition {{request()->routeIs('home') ? 'text-primary' : ''}}">Home</a>
                    <a href="{{route('user.products')}}" class="text-gray-600 hover:text-primary font-medium transition {{request()->routeIs('user.products') ? 'text-primary' : ''}}">Shop</a>
                    <a href="#categories" class="text-gray-600 hover:text-primary font-medium transition">Categories</a>
                </div>

                <!-- Search Bar (Desktop) -->
                <div class="hidden lg:flex flex-1 max-w-md mx-8">
                    <form action="{{route('user.products')}}" method="GET" class="w-full relative">
                        <input type="text" name="q" placeholder="Search for products..." 
                            class="w-full bg-gray-50 border border-gray-200 rounded-full py-2.5 pl-5 pr-12 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all"
                            value="{{request('q')}}">
                        <button type="submit" class="absolute right-1 top-1 bottom-1 bg-primary text-white rounded-full w-9 h-9 flex items-center justify-center hover:bg-purple-700 transition">
                            <i class="ph-bold ph-magnifying-glass"></i>
                        </button>
                    </form>
                </div>

                <!-- Icons -->
                <div class="flex items-center gap-2 sm:gap-4">
                    
                    <!-- Mobile Search Toggle -->
                    <button @click="searchOpen = !searchOpen" class="lg:hidden p-2 text-gray-600 hover:text-primary transition rounded-full hover:bg-gray-50">
                        <i class="ph-bold ph-magnifying-glass text-xl"></i>
                    </button>

                    <!-- Cart -->
                    <a href="{{route('cart.index')}}" class="relative p-2 text-gray-600 hover:text-primary transition rounded-full hover:bg-gray-50 group">
                        <i class="ph-bold ph-shopping-bag text-xl group-hover:scale-110 transition-transform"></i>
                        @if(Auth::check() && Auth::user()->cart?->cartItems()->count() > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-accent rounded-full border-2 border-white">
                            {{Auth::user()->cart->cartItems()->count()}}
                        </span>
                        @endif
                    </a>

                    <!-- User Menu -->
                    @if(Auth::check())
                    <div class="relative group" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 p-1 pr-3 rounded-full hover:bg-gray-50 transition border border-transparent hover:border-gray-100">
                            <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center text-primary font-bold text-sm">
                                {{substr(Auth::user()->name, 0, 1)}}
                            </div>
                            <i class="ph-bold ph-caret-down text-gray-400 text-xs"></i>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 border border-gray-100 z-50">
                            <div class="px-4 py-2 border-b border-gray-50">
                                <p class="text-sm font-medium text-gray-900 truncate">{{Auth::user()->name}}</p>
                                <p class="text-xs text-gray-500 truncate">{{Auth::user()->email}}</p>
                            </div>
                            <a href="{{route('profile')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-primary">Profile</a>
                            <a href="{{route('order.index')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-primary">My Orders</a>
                            <div class="border-t border-gray-50 my-1"></div>
                            <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Sign out</a>
                        </div>
                    </div>
                    @else
                    <a href="{{route('login.show')}}" class="p-2 text-gray-600 hover:text-primary transition rounded-full hover:bg-gray-50">
                        <i class="ph-bold ph-user text-xl"></i>
                    </a>
                    @endif

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-gray-600 hover:text-primary focus:outline-none">
                        <i class="ph-bold ph-list text-2xl" x-show="!mobileMenuOpen"></i>
                        <i class="ph-bold ph-x text-2xl" x-show="mobileMenuOpen" x-cloak></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Search Bar -->
            <div x-show="searchOpen" x-collapse class="lg:hidden pb-4">
                <form action="{{route('user.products')}}" method="GET" class="w-full relative">
                    <input type="text" name="q" placeholder="Search for products..." 
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 pl-4 pr-10 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                        value="{{request('q')}}">
                    <button type="submit" class="absolute right-2 top-2 text-gray-400 hover:text-primary">
                        <i class="ph-bold ph-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" x-collapse class="md:hidden bg-white border-t border-gray-100">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="{{route('home')}}" class="block px-3 py-3 text-base font-medium text-gray-700 hover:text-primary hover:bg-purple-50 rounded-lg">Home</a>
                <a href="{{route('user.products')}}" class="block px-3 py-3 text-base font-medium text-gray-700 hover:text-primary hover:bg-purple-50 rounded-lg">Shop</a>
                <a href="#categories" class="block px-3 py-3 text-base font-medium text-gray-700 hover:text-primary hover:bg-purple-50 rounded-lg">Categories</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-1">
                    <a href="{{route('home')}}" class="flex items-center gap-2 mb-4">
                        <span class="text-2xl font-bold text-primary tracking-tight">Kina</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-accent mt-2"></span>
                    </a>
                    <p class="text-gray-500 text-sm leading-relaxed mb-6">
                        Discover the joy of childhood with our curated collection of premium kids' fashion and toys.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-8 h-8 rounded-full bg-secondary flex items-center justify-center text-primary hover:bg-primary hover:text-white transition">
                            <i class="ph-fill ph-facebook-logo"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-secondary flex items-center justify-center text-primary hover:bg-primary hover:text-white transition">
                            <i class="ph-fill ph-instagram-logo"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-secondary flex items-center justify-center text-primary hover:bg-primary hover:text-white transition">
                            <i class="ph-fill ph-twitter-logo"></i>
                        </a>
                    </div>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="font-bold text-gray-900 mb-6">Shop</h4>
                    <ul class="space-y-3 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-primary transition">New Arrivals</a></li>
                        <li><a href="#" class="hover:text-primary transition">Best Sellers</a></li>
                        <li><a href="#" class="hover:text-primary transition">Sale</a></li>
                        <li><a href="#" class="hover:text-primary transition">Collections</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-900 mb-6">Support</h4>
                    <ul class="space-y-3 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-primary transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-primary transition">Shipping & Returns</a></li>
                        <li><a href="#" class="hover:text-primary transition">Size Guide</a></li>
                        <li><a href="#" class="hover:text-primary transition">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400 text-sm">&copy; 2025 Kina Store. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>