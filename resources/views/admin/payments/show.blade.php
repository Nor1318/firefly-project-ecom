@extends('../../components/layouts.admin.app')

@section('title', 'Payment Details - Admin Dashboard')

@section('heading','Payment')

@section('content')

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Payment Details</h2>
            <p class="text-sm text-gray-500 mt-1">Transaction information</p>
        </div>
        <a href="{{route('payments.index')}}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
            Back to List
        </a>
    </div>

    <div class="p-6 max-w-3xl">
        <div class="bg-gray-50 rounded-lg border border-gray-100 p-6 space-y-8">
            {{-- Payment Header --}}
            <div class="flex items-center justify-between border-b border-gray-200 pb-6">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Total Amount</p>
                    <h3 class="text-3xl font-bold text-gray-900">Rs {{number_format($payment->amount, 2)}}</h3>
                </div>
                <div>
                    @if($payment->status == 'completed')
                    <span class="px-4 py-2 rounded-full text-sm font-bold bg-green-100 text-green-800 border border-green-200">
                        Payment Completed
                    </span>
                    @elseif($payment->status == 'pending')
                    <span class="px-4 py-2 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                        Payment Pending
                    </span>
                    @else
                    <span class="px-4 py-2 rounded-full text-sm font-bold bg-gray-100 text-gray-800 border border-gray-200">
                        {{ucfirst($payment->status)}}
                    </span>
                    @endif
                </div>
            </div>

            {{-- Payment Info Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <p class="text-sm text-gray-500 mb-1">Transaction ID</p>
                    <p class="font-mono text-gray-900">{{$payment->transaction_code}}</p>
                </div>
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <p class="text-sm text-gray-500 mb-1">Payment Method</p>
                    <p class="font-medium text-gray-900">{{ucfirst($payment->payment_method)}}</p>
                </div>
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <p class="text-sm text-gray-500 mb-1">Order ID</p>
                    <a href="{{route('orders.show', $payment->order_id)}}" class="font-medium text-purple-600 hover:text-purple-800 hover:underline">
                        #{{$payment->order_id}}
                    </a>
                </div>
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <p class="text-sm text-gray-500 mb-1">Payment Date</p>
                    <p class="font-medium text-gray-900">{{$payment->created_at->format('M d, Y h:i A')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection