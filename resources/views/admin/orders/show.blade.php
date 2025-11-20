@extends('../../components/layouts.admin.app')

@section('title', 'Order View - Admin Dashboard')

@section('heading','Order')

@section('content')



<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">Order Details</h2>
        <button class="px-4 py-2 bg-blue-800 text-white rounded">Back</button>
    </div>

    <div class="p-6">
        <div class="space-y-4">


            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">ID</label>
                <p class="text-sm text-gray-900">{{$order->id}}</p>
            </div>

            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">User ID</label>
                <p class="text-sm text-gray-900">{{$order->user->id}}</p>
            </div>
            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Address ID</label>
                <p class="text-sm text-gray-900">{{$order->address->id}}</p>
            </div>

            <div class="">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Status</label>
                <p class="text-sm text-gray-900">{{$order->status}}</p>
            </div>

            <button class="px-2 py-1 border bg-yellow-800 border-yellow-700 text-white rounded-3xl"><a href="{{route('orders.edit',$order->id)}}">Change Status</a></button>
        </div>


    </div>
</div>



<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">Order Items List</h2>
        <button class="px-4 py-2 bg-blue-800 text-white rounded"><a href="{{route('order_items.create',1)}}">Add Order Item</a></button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount Per Item</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($orderItems as $orderItem)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$orderItem->id}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$orderItem->order->id}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$orderItem->product->id}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$orderItem->amount_per_item}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$orderItem->quantity}}</td>

                    <td class="px-6 py-4 text-sm">
                        <button class="px-2 py-1 border bg-green-800 border-green-700 text-white rounded-3xl"><a href="{{route('order_items.show',['$order->id',$orderItem->id])}}">View</a></button>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection