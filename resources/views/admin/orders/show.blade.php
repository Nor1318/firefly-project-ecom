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
                <h1 class="text-2xl font-semibold">View Order</h1>
                <button class="px-4 py-2 bg-gray-800 text-white rounded">Logout</button>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b flex justify-between m-2">
                    <h2 class="text-lg font-semibold">Order Details</h2>
                    <button class="px-4 py-2 bg-blue-800 text-white rounded">Back</button>
                </div>

                <div class="p-6">
                    <div class="space-y-4">


                        <div class=" pb-4">
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-1">ID</label>
                            <p class="text-sm text-gray-900">1</p>
                        </div>

                        <div class=" pb-4">
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-1">User ID</label>
                            <p class="text-sm text-gray-900">1</p>
                        </div>
                        <div class=" pb-4">
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Address ID</label>
                            <p class="text-sm text-gray-900">1</p>
                        </div>

                        <div class="">
                            <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Status</label>
                            <p class="text-sm text-gray-900">Completed</p>
                        </div>


                    </div>

                    <div class="flex gap-2 mt-6 pt-4">
                        <button class="px-4 py-2 bg-yellow-700 text-white rounded"><a href="{{route('orders.edit',1)}}">Edit</a></button>
                        <button class="px-4 py-2 bg-red-800 text-white rounded">Delete</button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b flex justify-between m-2">
                    <h2 class="text-lg font-semibold">Order Item List</h2>
                    <button class="px-4 py-2 bg-blue-800 text-white rounded"><a href="{{route('users.create')}}">Add Order Item</a></button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount Per Item</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">1</td>
                                <td class="px-6 py-4 text-sm text-gray-900">13</td>
                                <td class="px-6 py-4 text-sm text-gray-900">100</td>
                                <td class="px-6 py-4 text-sm text-gray-900 ">100</td>

                                <td class="px-6 py-4 text-sm">
                                    <button class="px-2 py-1 border bg-green-800 border-green-700 text-white rounded-3xl"><a href="{{route('orders.show',1)}}">View</a></button>
                                    <button class="px-2 py-1 border bg-yellow-800 border-yellow-700 text-white rounded-3xl"><a href="{{route('orders.edit',1)}}">Edit</a></button>
                                    <button class="px-2 py-1 border bg-red-800 border-red-700 text-white rounded-3xl">Delete</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </main>

    </div>

</body>

</html>