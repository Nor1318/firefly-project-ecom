<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product - Admin Dashboard</title>
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
                <h1 class="text-2xl font-semibold">View Product</h1>
                <button class="px-4 py-2 bg-gray-800 text-white rounded">Logout</button>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b flex justify-between m-2">
                    <h2 class="text-lg font-semibold">Product Details</h2>
                    <button onclick="history.back()" class="px-4 py-2 bg-gray-800 text-white rounded">Back</button>
                </div>

                <div class="p-6">
                    <div class="space-y-4">
                        <div class=" pb-4">
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Product ID</label>
                            <p class="text-sm text-gray-900">1</p>
                        </div>

                        <div class=" pb-4">
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Image</label>
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS26HpPzA74ujrmAeSLZ-pbuLm8SUJeY_Wv9w&s" alt="Product" class="w-32 h-32 object-cover rounded">
                        </div>

                        <div class=" pb-4">
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Name</label>
                            <p class="text-sm text-gray-900">Dell Laptop</p>
                        </div>

                        <div class=" pb-4">
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Slug</label>
                            <p class="text-sm text-gray-900">dell-laptop</p>
                        </div>

                        <div class=" pb-4">
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Category</label>
                            <p class="text-sm text-gray-900">Electronics</p>
                        </div>

                        <div class=" pb-4">
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Price</label>
                            <p class="text-sm text-gray-900">999.99</p>
                        </div>

                        <div class=" pb-4">
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Quantity</label>
                            <p class="text-sm text-gray-900">25</p>
                        </div>

                        <div class="pb-4">
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Description</label>
                            <p class="text-m text-gray-900">High-performance laptop with latest Intel processor, 16GB RAM, and 512GB SSD. Perfect for work and gaming.</p>
                        </div>
                    </div>

                    <div class="flex gap-2 mt-6 pt-4">
                        <button class="px-4 py-2 bg-yellow-700 text-white rounded"><a href="{{route('products.edit',1)}}">Edit</a></button>
                        <button class="px-4 py-2 bg-red-800 text-white rounded">Delete</button>
                    </div>
                </div>
            </div>
        </main>

    </div>

</body>

</html>