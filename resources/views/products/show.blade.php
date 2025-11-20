@use('Illuminate\Support\Str')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">
    <header class="bg-white shadow-sm">
        <nav class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="text-xl font-bold text-gray-900">Firefly Store</div>
            <div class="flex items-center space-x-8">
                <a href="{{route('home')}}" class="text-gray-600 hover:text-gray-900">Home</a>
                <a href="{{route('products.index')}}" class="text-gray-600 hover:text-gray-900">Products</a>

                <div class="flex items-center space-x-4">
                    <a href="{{route('cart.index')}}" class="relative text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="absolute -top-2 -right-2 bg-gray-900 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{Auth::check() ? (Auth::user()->cart?->cartItems()->count() ?? 0) : 0}}</span>
                    </a>
                    @if(Auth::check())
                    <!-- User dropdown -->
                    <div class="relative group">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-600">Hello, {{Str::of(Auth::user()->name)->before(' ')}}</span>
                            <button class="text-gray-600 hover:text-gray-900 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Dropdown menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Orders</a>
                            <div class="border-t border-gray-100"></div>
                            <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign out</a>
                        </div>
                    </div>

                    @else
                    <div class="relative group">
                        <div class="flex items-center space-x-2">

                            <button class="text-gray-600 hover:text-gray-900 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Dropdown menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">

                            <div class="border-t border-gray-100"></div>
                            <a href="{{route('login.show')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                        </div>
                    </div>

                    @endif
                </div>
            </div>
        </nav>
    </header>


    <main class="max-w-6xl mx-auto px-6 py-16">
        @session('success')
        <div id="temp-message" class=" w-full bg-red-800 rounded-lg  text-white h-6 flex justify-center text-align-center alert alert-success m-5">{{$value}}</div>
        @endsession

        <div class="grid md:grid-cols-2 gap-16">


            <div>
                <div class=" bg-gray-100 rounded-lg overflow-hidden">
                    <img src="/storage/{{$product->image}}" alt="Product" class="w-full h-full object-cover">
                </div>
            </div>


            <div class="flex flex-col justify-center">

                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{$product->name}}</h1>

                <p class="text-gray-600 text-md mb-8 leading-relaxed">
                    {{$product->description}}
                </p>

                <div class="mb-8">
                    <span class="text-2xl font-semi-bold text-gray-900">Rs {{$product->price}}</span>
                </div>
                <form action="{{route('cart.add', $product->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="source_page" value="product_show">
                    <button type='submit' class="w-full bg-black text-white font-medium py-4 rounded-lg ">
                        Add to Cart
                    </button>

                </form>

            </div>
        </div>

    </main>
    <script>
        setTimeout(() => document.getElementById('temp-message').classList.add('hidden'), 2000);
    </script>
</body>

</html>