@extends('../components/layouts.admin.app')

@section('title', 'Admin Dashboard')

@section('heading','Dashboard')

@section('content')


<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">


    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Users</p>
                <p class="text-3xl font-bold text-gray-900">{{$users}}</p>
            </div>

        </div>
    </div>


    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Categories</p>
                <p class="text-3xl font-bold text-gray-900">{{$categories}}</p>
            </div>

        </div>
    </div>


    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Products</p>
                <p class="text-3xl font-bold text-gray-900">{{$products}}</p>
            </div>

        </div>
    </div>


    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Orders</p>
                <p class="text-3xl font-bold text-gray-900">{{$orders}}</p>
            </div>

        </div>
    </div>


    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-shadow lg:col-span-2">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Revenue</p>
                <p class="text-3xl font-bold text-gray-900">Rs {{$totalRevenue}}</p>

            </div>

        </div>
    </div>

</div>
@endsection