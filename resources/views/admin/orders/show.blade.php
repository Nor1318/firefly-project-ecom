@extends('../../components/layouts.admin.app')

@section('title', 'Order Details - Admin Dashboard')

@section('heading','Order')

@section('content')

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Order #{{$order->id}}</h2>
            <p class="text-sm text-gray-500 mt-1">Placed on {{$order->created_at->format('M d, Y h:i A')}}</p>
        </div>
        <a href="{{route('orders.index')}}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
            Back to List
        </a>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Left Column: Order Items --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-gray-50 rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-100">
                        <h3 class="font-semibold text-gray-900">Order Items</h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($order->orderItems as $item)
                        <div class="p-6 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                @if($item->product && $item->product->image)
                                <img src="/storage/{{$item->product->image}}" alt="{{$item->product->name}}" class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                                @else
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">No Img</span>
                                </div>
                                @endif
                                <div>
                                    <h4 class="font-medium text-gray-900">{{$item->product ? $item->product->name : 'Product Deleted'}}</h4>
                                    <p class="text-sm text-gray-500">Qty: {{$item->quantity}}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-gray-900">Rs {{number_format($item->price * $item->quantity, 2)}}</p>
                                <p class="text-xs text-gray-500">Rs {{number_format($item->price, 2)}} each</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-gray-900">Total Amount</span>
                            <span class="text-xl font-bold text-purple-600">Rs {{number_format($order->total_amount, 2)}}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Customer & Status --}}
            <div class="space-y-6">
                {{-- Status Card --}}
                <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                    <h3 class="font-semibold text-gray-900 mb-4">Order Status</h3>
                    <div class="mb-4">
                        @if($order->status == 'completed')
                        <span class="w-full block text-center px-3 py-2 rounded-lg bg-green-100 text-green-800 font-semibold">Completed</span>
                        @elseif($order->status == 'pending')
                        <span class="w-full block text-center px-3 py-2 rounded-lg bg-yellow-100 text-yellow-800 font-semibold">Pending</span>
                        @elseif($order->status == 'processing')
                        <span class="w-full block text-center px-3 py-2 rounded-lg bg-blue-100 text-blue-800 font-semibold">Processing</span>
                        @else
                        <span class="w-full block text-center px-3 py-2 rounded-lg bg-gray-100 text-gray-800 font-semibold">{{ucfirst($order->status)}}</span>
                        @endif
                    </div>
                </div>

                {{-- Customer Info --}}
                <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                    <h3 class="font-semibold text-gray-900 mb-4">Customer Details</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-bold text-xs">
                                {{substr($order->user->name, 0, 1)}}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{$order->user->name}}</p>
                                <p class="text-xs text-gray-500">{{$order->user->email}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Shipping Address --}}
                <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                    <h3 class="font-semibold text-gray-900 mb-4">Shipping Address</h3>
                    <div class="text-sm text-gray-600 space-y-1">
                        <p class="font-medium text-gray-900">{{$order->address->full_name}}</p>
                        <p>{{$order->address->address}}</p>
                        <p>{{$order->address->city}}, {{$order->address->state}} {{$order->address->zip_code}}</p>
                        <p>{{$order->address->country}}</p>
                        <p class="mt-2 text-gray-500">Phone: {{$order->address->phone}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection