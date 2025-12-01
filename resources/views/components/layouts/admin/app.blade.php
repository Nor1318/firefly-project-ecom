<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-gray-50">

    <div class="min-h-screen flex">

        {{-- Sidebar - Clean & Minimalist --}}
        <aside class="w-64 bg-white shadow-sm border-r border-gray-200">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-2xl font-bold text-purple-600">
                    Babyland
                </h2>
                <p class="text-xs text-gray-500 mt-1">Admin Panel</p>
            </div>
            
            <nav class="p-4 space-y-1">
                <a href="{{route('admin')}}" class="flex items-center px-4 py-3 text-sm font-medium {{request()->routeIs('admin') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-50'}} rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{route('products.index')}}" class="flex items-center px-4 py-3 text-sm font-medium {{request()->routeIs('products.*') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-50'}} rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Products
                </a>
                <a href="{{route('categories.index')}}" class="flex items-center px-4 py-3 text-sm font-medium {{request()->routeIs('categories.*') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-50'}} rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Categories
                </a>
                <a href="{{route('orders.index')}}" class="flex items-center px-4 py-3 text-sm font-medium {{request()->routeIs('orders.*') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-50'}} rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Orders
                </a>
                <a href="{{route('users.index')}}" class="flex items-center px-4 py-3 text-sm font-medium {{request()->routeIs('users.*') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-50'}} rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Customers
                </a>
                <a href="{{route('payments.index')}}" class="flex items-center px-4 py-3 text-sm font-medium {{request()->routeIs('payments.*') ? 'text-purple-600 bg-purple-50' : 'text-gray-700 hover:bg-gray-50'}} rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Payments
                </a>
            </nav>
        </aside>


        <main class="flex-1 overflow-auto">
            {{-- Header --}}
            <div class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
                <div class="flex items-center justify-between px-8 py-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">@yield('heading')</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                <span class="text-purple-600 font-semibold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                                <a href="{{route('logout')}}" class="text-gray-400 hover:text-gray-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <div class="p-6">
                @yield('content')
            </div>
        </main>

    </div>
    @stack('scripts')
</body>

</html>