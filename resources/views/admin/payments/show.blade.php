@extends('../../components/layouts.admin.app')

@section('title', 'View Payment - Admin Dashboard')

@section('heading','Payment')

@section('content')


<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">View Payment</h2>

    </div>

    <div class="p-6">
        <div class="space-y-4">
            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">PAYMENT ID</label>
                <p class="text-sm text-gray-900">{{$payment->id}}</p>
            </div>
            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">ORDER ID</label>
                <p class="text-sm text-gray-900">{{$payment->order->id}}</p>
            </div>


            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Payment Method</label>
                <p class="text-sm text-gray-900">{{$payment->payment_method}}</p>
            </div>

            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Transaction Code</label>
                <p class="text-sm text-gray-900">{{$payment->transaction_code}}</p>
            </div>

            <div class="">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Status</label>
                <p class="text-sm text-gray-900">{{$payment->status}}</p>
            </div>

        </div>


    </div>
</div>

@endsection