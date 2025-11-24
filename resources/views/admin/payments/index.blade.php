@extends('../../components/layouts.admin.app')

@section('title', 'Payment - Admin Dashboard')

@section('heading','Payment')

@section('content')



<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">Payment List</h2>

    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">

                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Payment Method</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Transaction Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($payments as $payment)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$payment->id}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$payment->order->id}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$payment->payment_method}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$payment->transaction_code}}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="font-bold text-xs">{{$payment->status}}</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <button class="px-2 py-1 border bg-green-800 border-green-700 text-white rounded-3xl"><a href="{{route('payments.show',$payment->id)}}">View</a></button>

                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection