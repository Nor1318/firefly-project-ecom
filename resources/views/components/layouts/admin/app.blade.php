<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">

    <div class="min-h-screen flex">


        <aside class="w-64 bg-white shadow-sm">
            <div class="p-6 border-b flex justify-center border-gray-300">
                <h2 class="text-2xl font-bold text-gray-800">Kina</h2>
            </div>
            <nav class="p-4 space-y-1">
                <a href="{{route('admin')}}" class="flex items-center px-4 py-3 text-sm font-medium {{request()->routeIs('admin') ? 'bg-gray-800 text-white ' : 'text-gray-700'}} rounded-lg transition-colors">
                    Dashboard
                </a>
                <a href="{{route('users.index')}}" class="flex items-center px-4 py-3 text-sm font-medium {{request()->routeIs('users.index') ? 'bg-gray-800 text-white ' : 'text-gray-700 '}} rounded-lg">
                    Users
                </a>
                <a href="{{route('categories.index')}}" class="flex items-center px-4 py-3 text-sm font-medium {{request()->routeIs('categories.index') ? 'bg-gray-800 text-white ' : 'text-gray-700 '}} text-gray-700 rounded-lg">
                    Categories
                </a>
                <a href="{{route('products.index')}}" class="flex items-center px-4 py-3 text-sm font-medium {{request()->routeIs('products.index') ? 'bg-gray-800 text-white' : 'text-gray-700 '}} text-gray-700 rounded-lg">
                    Products
                </a>
                <a href="{{route('orders.index')}}" class="flex items-center px-4 py-3 text-sm font-medium {{request()->routeIs('orders.index') ? 'bg-gray-800 text-white' : 'text-gray-700 '}} text-gray-700 rounded-lg">
                    Orders
                </a>
                <a href="{{route('payments.index')}}" class="flex items-center px-4 py-3 text-sm font-medium {{request()->routeIs('payments.index') ? 'bg-gray-800 text-white' : 'text-gray-700 '}} text-gray-700 rounded-lg">
                    Payments
                </a>
            </nav>
        </aside>


        <main class="flex-1 p-8">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">@yield('heading')</h1>

                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-white px-4 py-2 rounded shadow">
                        <span class="text-sm text-gray-700">Hello, {{ auth()->user()->name }}</span>
                    </div>
                    <a href="{{route('logout')}}" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">Logout</a>
                </div>
            </div>


            @yield('content')


    </div>

</body>

</html>