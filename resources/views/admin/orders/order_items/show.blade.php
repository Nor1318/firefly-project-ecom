@extends('../../components/layouts.admin.app')

@section('title', 'OrderItem View - Admin Dashboard')

@section('heading','OrderItem')

@section('content')



<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">Order Item Information</h2>
        <button class="px-4 py-2 bg-blue-800 text-white rounded" onclick="history.back()">Back</button>
    </div>
    <div class="p-6">
        <div class="space-y-4">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">ID</p>
                <p class="text-sm text-gray-900">{{$orderItem->id}}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Order ID</p>
                <p class="text-sm text-gray-900">{{$orderItem->order->id}}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Product ID</p>
                <p class="text-sm text-gray-900">{{$orderItem->product->id}}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Amount Per Item</p>
                <p class="text-sm text-gray-900">{{$orderItem->amount_per_item}}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Quantity</p>
                <p class="text-sm text-gray-900">{{$orderItem->quantity}}</p>
            </div>
        </div>


    </div>
</div>
@endsection