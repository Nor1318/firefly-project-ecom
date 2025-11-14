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
                <h1 class="text-2xl font-semibold">Address</h1>
                <button class="px-4 py-2 bg-gray-800 text-white rounded">Logout</button>
            </div>


            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b m-2 flex justify-between m-2">
                    <h2 class="text-lg font-semibold">Add New Address</h2>
                    <a href="{{route('users.show',1)}}" class="px-6 py-2 bg-blue-700 text-white rounded-lg">
                        Back
                    </a>
                </div>
                <div class="p-6">
                    <form action="" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="street1" class="block text-sm font-medium text-gray-700 mb-2">Street Address 1</label>
                            <input type="text" id="street1" name="street1"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg "
                                placeholder="Enter street address">
                        </div>

                        <div class="mb-4">
                            <label for="street2" class="block text-sm font-medium text-gray-700 mb-2">Street Address 2 (Optional)</label>
                            <input type="text" id="street2" name="street2"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg "
                                placeholder="Enter Street 2">
                        </div>


                        <div class="mb-4">
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                            <input type="text" id="city" name="city"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg "
                                placeholder="Enter city">
                        </div>

                        <div class="mb-4">
                            <label for="state" class="block text-sm font-medium text-gray-700 mb-2">State/Province</label>
                            <input type="text" id="state" name="state"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg "
                                placeholder="Enter state">

                        </div>

                        <div class="mb-6">
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                            <input type="text" id="country" name="country"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg "
                                placeholder="Enter country">
                        </div>

                        <div class="flex gap-4">
                            <button type="submit" class="px-6 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Save Address
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </main>

    </div>

</body>

</html>