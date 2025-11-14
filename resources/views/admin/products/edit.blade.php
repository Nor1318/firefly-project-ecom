<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product - Admin Dashboard</title>
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
                <h1 class="text-2xl font-semibold">Create Product</h1>
                <button class="px-4 py-2 bg-gray-800 text-white rounded">Logout</button>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b flex justify-between m-2">
                    <h2 class="text-lg font-semibold">Edit Product</h2>
                    <button class="px-4 py-2 bg-blue-800 text-white rounded"><a href="{{route('products.index')}}">Back</a></button>
                </div>

                <div class="p-6">
                    <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Name</label>
                            <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded " placeholder="Enter product name">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Slug</label>
                            <input type="text" name="slug" class="w-full px-4 py-2 border border-gray-300 rounded " placeholder="Enter product slug">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Category</label>
                            <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded ">
                                <option value="">Select Category</option>
                                <option value="1">Electronics</option>
                                <option value="2">Mobile</option>
                                <option value="3">Accessories</option>
                                <option value="4">Laptops</option>
                                <option value="5">Gaming</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Price</label>
                            <input type="number" name="price" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded " placeholder="Enter price">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Quantity</label>
                            <input type="number" name="quantity" class="w-full px-4 py-2 border border-gray-300 rounded " placeholder="Enter quantity">
                        </div>

                        <div>
                            <label class="block ">Image</label>
                            <input type="file" name="image" class="px-4 py-2" accept="image/*">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Description</label>
                            <textarea name="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded" placeholder="Enter product description"></textarea>
                        </div>

                        <div class="flex gap-2 pt-4 ">
                            <button type="submit" class="px-4 py-2 bg-yellow-800 text-white rounded">Edit Product</button>

                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>

</body>

</html>