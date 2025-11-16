<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">

        <aside class="w-64 bg-white">
            <div class="p-4 text-xl font-bold text-center border-b-1">
                Admin Panel
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{route('admin')}}" class="block px-4 py-2 rounded click focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500">Dashboard</a>
                <a href="{{route('users.index')}}" class="block px-4 py-2 rounded click focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500">User</a>
                <a href="{{route('categories.index')}}" class="block px-4 py-2 rounded click focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500">Category</a>
                <a href="{{route('products.index')}}" class="block px-4 py-2 rounded click focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500">Product</a>
                <a href="{{route('orders.index')}}" class="block px-4 py-2 rounded click focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500">Order</a>
                <a href="{{route('payments.index')}}" class="block px-4 py-2 rounded click focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500">Payment</a>
            </nav>
        </aside>

        <main class="flex-auto p-6">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold">Order Item</h1>
                <button class="px-4 py-2 bg-gray-800 text-white rounded">Logout</button>
            </div>


            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b flex justify-between m-2">
                    <h2 class="text-lg font-semibold">Edit Order Item</h2>
                    <button class="px-4 py-2 bg-blue-800 text-white rounded"><a href="{{route('orders.show',1)}}">Back</a></button>
                </div>
                <div class="p-6">
                    <form action="" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="order_id" class="block text-sm font-medium text-gray-700 mb-2">Order ID</label>
                            <input type="number" id="order_id" name="order_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg "
                                placeholder="Enter order ID">
                        </div>

                        <div class="mb-4">
                            <label for="product_id" class="block text-sm font-medium text-gray-700 mb-2">Product ID</label>
                            <input type="number" id="product_id" name="product_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg "
                                placeholder="Enter product ID">
                        </div>


                        <div class="mb-4">
                            <label for="amount_per_item" class="block text-sm font-medium text-gray-700 mb-2">Amount Per Item</label>
                            <input type="number" step="0.01" id="amount_per_item" name="amount_per_item"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg "
                                placeholder="Enter amount">
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                            <input type="number" id="quantity" name="quantity"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg "
                                placeholder="Enter quantity">
                        </div>


                        <div class="flex gap-4 pt-2">
                            <button type="submit" class="px-6 py-2 bg-blue-800 text-white rounded-lg ">
                                Add Order Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>

</body>

</html>