<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Admin Dashboard</title>
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
                <h1 class="text-2xl font-semibold">Payment</h1>
                <button class="px-4 py-2 bg-gray-800 text-white rounded">Logout</button>
            </div>


            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b flex justify-between m-2">
                    <h2 class="text-lg font-semibold">Payment List</h2>
                    <button class="px-4 py-2 bg-blue-800 text-white rounded"><a href="{{route('payments.create')}}">Add Payment</a></button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Payment Method</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Transaction Code</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">1</td>
                                <td class="px-6 py-4 text-sm text-gray-900">1</td>
                                <td class="px-6 py-4 text-sm text-gray-900">Cash</td>
                                <td class="px-6 py-4 text-sm text-gray-900">12345678</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="font-bold text-xs">Completed</span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <button class="px-2 py-1 border bg-green-800 border-green-700 text-white rounded-3xl"><a href="{{route('payments.show',1)}}">View</a></button>
                                    <button class="px-2 py-1 border bg-yellow-800 border-yellow-700 text-white rounded-3xl"><a href="{{route('payments.edit',1)}}">Edit</a></button>
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