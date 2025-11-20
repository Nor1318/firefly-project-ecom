@extends('components/layouts.app')

@section('content')

<main class="max-w-7xl mx-auto px-6 py-12">
    @session('failedPayment')
    <div>{{$value}}</div>
    @endsession

    <div class="space-y-6">
        @foreach($orders as $order)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Order {{$order->id}}</h3>
                    </div>
                    <div class="mt-2 md:mt-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-1"></i> {{$order->status}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                    <div class="flex items-center gap-4">
                        <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center flex-shrink-0">
                            <img src="/storage/{{$item->product->image}}" alt="{{$item->product->name}}" class="w-full h-full object-cover rounded">
                        </div>
                        <div class="flex-grow">
                            <h4 class="font-medium text-gray-900">{{$item->product->name}}</h4>
                            <p class="text-gray-600 text-sm">{{$item->description}}</p>
                            <p class="text-gray-900 font-medium mt-1">Rs {{$item->product->price}}</p>
                        </div>
                        <div class="text-gray-600">
                            Qty: {{$item->quantity}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>


</main>
@endsection