@extends('components/layouts.app')

@section('content')

<main class="max-w-5xl mx-auto px-4 sm:px-6 py-12">

    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('order.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-primary transition">
            <i class="ph-bold ph-arrow-left"></i>
            <span>Back to Orders</span>
        </a>
    </div>

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
        <p class="text-gray-500 mt-2">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
    </div>

    @php
        $statusStyles = [
            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
            'processing'=> 'bg-blue-100 text-blue-800 border-blue-200',
            'confirmed' => 'bg-green-100 text-green-800 border-green-200',
            'completed' => 'bg-green-100 text-green-800 border-green-200',
            'paid' => 'bg-green-100 text-green-800 border-green-200',
            'cancelled' => 'bg-red-100 text-red-800 border-red-200',
            'failed' => 'bg-red-100 text-red-800 border-red-200',
        ];
        $currentStyle = $statusStyles[strtolower($order->status)] ?? 'bg-gray-100 text-gray-800 border-gray-200';
        $subtotal = 0;
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Order Items -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Order Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900">Order Status</h2>
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold uppercase tracking-wide border {{ $currentStyle }}">
                        {{ $order->status }}
                    </span>
                </div>
            </div>

            <!-- Order Items Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-900">Order Items</h2>
                </div>

                <div class="divide-y divide-gray-100">
                    @foreach($order->orderItems as $item)
                    @php 
                        $itemTotal = $item->product->price * $item->quantity;
                        $subtotal += $itemTotal;
                    @endphp
                    
                    <div class="p-6">
                        <div class="flex gap-6">
                            <!-- Product Image -->
                            <div class="w-24 h-24 bg-gray-100 rounded-lg flex-shrink-0 overflow-hidden border border-gray-200">
                                <img src="/storage/{{$item->product->image}}"
                                    alt="{{$item->product->name}}"
                                    class="w-full h-full object-cover">
                            </div>

                            <!-- Product Details -->
                            <div class="flex-grow">
                                <h3 class="font-bold text-gray-900 text-lg mb-4">{{$item->product->name}}</h3>
                                
                                <div class="flex items-center gap-6 text-sm">
                                    <div>
                                        <span class="text-gray-500">Price:</span>
                                        <span class="font-semibold text-gray-900">Rs {{number_format($item->product->price, 2)}}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Quantity:</span>
                                        <span class="font-semibold text-gray-900">{{$item->quantity}}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-500">Total:</span>
                                        <span class="font-bold text-primary text-base">Rs {{number_format($itemTotal, 2)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-24 space-y-6">
                
                <!-- Order Summary -->
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Order Summary</h2>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-semibold text-gray-900">Rs {{number_format($subtotal, 2)}}</span>
                        </div>
                        
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-semibold text-gray-900">Rs 100.00</span>
                        </div>
                        
                        <div class="pt-3 border-t border-gray-200">
                            <div class="flex justify-between">
                                <span class="text-base font-bold text-gray-900">Total</span>
                                <span class="text-2xl font-bold text-primary">Rs {{number_format($subtotal + 100, 2)}}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-bold text-gray-900 mb-3">Payment Method</h3>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-50 rounded-lg flex items-center justify-center">
                            <i class="ph-fill ph-credit-card text-primary text-lg"></i>
                        </div>
                        <span class="font-semibold text-gray-900 capitalize">
                            {{ $order->payment ? $order->payment->payment_method : 'N/A' }}
                        </span>
                    </div>
                </div>

                <!-- Order Info -->
                <div class="pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-bold text-gray-900 mb-3">Order Information</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Order ID:</span>
                            <span class="font-semibold text-gray-900">#{{ $order->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Order Date:</span>
                            <span class="font-semibold text-gray-900">{{ $order->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Items:</span>
                            <span class="font-semibold text-gray-900">{{ $order->orderItems->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection
