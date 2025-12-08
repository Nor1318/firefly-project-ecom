@extends('../../components/layouts.admin.app')

@section('title', 'Order Details - Admin Dashboard')

@section('heading','Order')

@section('content')

{{-- Success Message --}}
@if(session('success'))
<div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
    </button>
</div>
@endif

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
    <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Order #{{$order->id}}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Placed on {{$order->created_at->format('M d, Y h:i A')}}</p>
        </div>
        <div class="flex gap-2">
            {{-- Download Invoice Button --}}
            <a href="{{route('orders.invoice.download', $order)}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 focus:ring-purple-500 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Download Invoice
            </a>
            
            {{-- Email Invoice Button --}}
            <form action="{{route('orders.invoice.email', $order)}}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 focus:ring-green-500 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Email Invoice
                </button>
            </form>
            
            {{-- Back Button --}}
            <a href="{{route('orders.index')}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 focus:ring-purple-500 transition-all duration-200">
                Back to List
            </a>
        </div>
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