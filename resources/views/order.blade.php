@extends('components/layouts.app')

@section('content')

<main class="max-w-5xl mx-auto px-4 sm:px-6 py-12">

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Your Orders</h1>
        <p class="text-gray-500 mt-2">Check the status of your recent purchases.</p>
    </div>

    <!-- 1. SUCCESS Notification -->
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

    <!-- 2. ERROR Notification (Matched to Controller's 'with(error)') -->
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

    <div class="space-y-8">
        @forelse($orders as $order)

        <!-- Order Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">

            <!-- Card Header -->
            <div class="bg-gray-50/50 p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3">
                        <h3 class="text-lg font-bold text-gray-900">
                            Order <span class="text-primary">#{{ $order->id }}</span>
                        </h3>
                        <span class="text-gray-400 text-sm">|</span>
                        <span class="text-sm text-gray-500">
                            {{ $order->created_at->format('M d, Y') }}
                        </span>
                    </div>
                </div>

                <!-- Dynamic Status Badge -->
                @php
                // 3. Added 'confirmed' to match your Controller
                $statusStyles = [
                'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                'processing'=> 'bg-blue-100 text-blue-800 border-blue-200',
                'confirmed' => 'bg-green-100 text-green-800 border-green-200', // Added this
                'completed' => 'bg-green-100 text-green-800 border-green-200',
                'paid' => 'bg-green-100 text-green-800 border-green-200',
                'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                'failed' => 'bg-red-100 text-red-800 border-red-200',
                ];
                $currentStyle = $statusStyles[strtolower($order->status)] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                @endphp

                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide border {{ $currentStyle }}">
                        {{ $order->status }}
                    </span>
                </div>
            </div>

            <!-- Card Body: Items List -->
            <div class="divide-y divide-gray-100">
                @php $orderTotal = 0; @endphp

                @foreach($order->orderItems as $item)
                @php $orderTotal += ($item->product->price * $item->quantity); @endphp

                <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center gap-6">
                    <!-- Image -->
                    <div class="w-20 h-20 bg-gray-100 rounded-lg flex-shrink-0 overflow-hidden border border-gray-200">
                        <img src="/storage/{{$item->product->image}}"
                            alt="{{$item->product->name}}"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Details -->
                    <div class="flex-grow min-w-0">
                        <h4 class="font-semibold text-gray-900 text-base truncate">{{$item->product->name}}</h4>
                        <p class="text-gray-500 text-sm line-clamp-1 mt-1">{{$item->product->description}}</p>
                    </div>

                    <!-- Price & Qty -->
                    <div class="text-right flex-shrink-0">
                        <p class="text-sm text-gray-500 mb-1">Rs {{$item->product->price}} x {{$item->quantity}}</p>
                        <p class="text-gray-900 font-bold">Rs {{ number_format($item->product->price * $item->quantity) }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Card Footer -->
            <div class="bg-gray-50 p-6 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-gray-200">
                <div class="text-sm text-gray-500">
                    Payment Method:
                    <span class="font-medium text-gray-900 capitalize">
                        {{-- This now works because you create Payment in store() --}}
                        {{ $order->payment ? $order->payment->payment_method : 'N/A' }}
                    </span>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-gray-600 text-sm">Order Total:</span>
                    <span class="text-xl font-bold text-gray-900">Rs {{ number_format($orderTotal + 100) }}</span>
                </div>
            </div>
        </div>
        @empty

        <!-- Empty State -->
        <div class="text-center py-16 bg-white rounded-lg border border-dashed border-gray-300">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                <i class="ph-bold ph-package text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900">No orders found</h3>
            <p class="text-gray-500 mt-1">Looks like you haven't placed any orders yet.</p>
            <a href="{{ route('home') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-green-800 transition">
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