@extends('components/layouts.app')

@section('content')

<main class="max-w-5xl mx-auto px-4 sm:px-6 py-12">

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Your Orders</h1>
        <p class="text-gray-500 mt-2">Check the status of your recent purchases.</p>
    </div>

    <!-- SUCCESS Notification -->
    @if(session('success'))
    <div class="mb-6 rounded-lg bg-green-50 p-4 border border-green-200 flex items-center gap-3">
        <div class="flex-shrink-0 text-green-500">
            <i class="ph-bold ph-check-circle text-xl"></i>
        </div>
        <div>
            <h3 class="text-sm font-medium text-green-800">Success</h3>
            <div class="text-sm text-green-700 mt-1">{{ session('success') }}</div>
        </div>
    </div>
    @endif

    <!-- ERROR Notification -->
    @if(session('error'))
    <div class="mb-6 rounded-lg bg-red-50 p-4 border border-red-200 flex items-center gap-3">
        <div class="flex-shrink-0 text-red-500">
            <i class="ph-bold ph-warning-circle text-xl"></i>
        </div>
        <div>
            <h3 class="text-sm font-medium text-red-800">Payment / Order Failed</h3>
            <div class="text-sm text-red-700 mt-1">{{ session('error') }}</div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($orders as $order)
        @php
            $orderTotal = $order->orderItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });
            
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
        @endphp

        <!-- Compact Order Card -->
        <a href="{{ route('order.show', $order->id) }}" class="block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:border-primary transition-all duration-200 cursor-pointer group">
            
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-gray-50 to-white p-6 border-b border-gray-100">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary transition-colors">
                        Order <span class="text-primary">#{{ $order->id }}</span>
                    </h3>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide border {{ $currentStyle }}">
                        {{ $order->status }}
                    </span>
                </div>
                
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <i class="ph-bold ph-calendar"></i>
                    <span>{{ $order->created_at->format('M d, Y') }}</span>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm text-gray-600">Total Items:</span>
                    <span class="text-sm font-semibold text-gray-900">{{ $order->orderItems->count() }} {{ Str::plural('item', $order->orderItems->count()) }}</span>
                </div>
                
                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm text-gray-600">Payment Method:</span>
                    <span class="text-sm font-semibold text-gray-900 capitalize">
                        {{ $order->payment ? $order->payment->payment_method : 'N/A' }}
                    </span>
                </div>

                <div class="pt-4 border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <span class="text-base font-semibold text-gray-700">Order Total:</span>
                        <span class="text-2xl font-bold text-primary">Rs {{ number_format($orderTotal + 100) }}</span>
                    </div>
                </div>
            </div>

            <!-- Card Footer -->
            <div class="bg-gray-50 px-6 py-4 flex items-center justify-between border-t border-gray-100">
                <span class="text-sm text-gray-600">Click to view details</span>
                <i class="ph-bold ph-arrow-right text-primary text-lg group-hover:translate-x-1 transition-transform"></i>
            </div>
        </a>
        @empty

        <!-- Empty State -->
        <div class="col-span-2 text-center py-16 bg-white rounded-lg border border-dashed border-gray-300">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                <i class="ph-bold ph-package text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900">No orders found</h3>
            <p class="text-gray-500 mt-1">Looks like you haven't placed any orders yet.</p>
            <a href="{{ route('home') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-purple-700 transition">
                Start Shopping
            </a>
        </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $orders->links() }}
    </div>

</main>
@endsection