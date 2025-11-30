@extends('../../components/layouts.admin.app')

@section('title', 'Order List - Admin Dashboard')

@section('heading','Order')

@section('content')



<div class="bg-white rounded-lg shadow  ">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">Orders List</h2>

    </div>
    <div>
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Address ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white ">
                @foreach($orders as $order)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$order->id}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$order->user->id}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$order->address->id}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <span class="px-2 py-1 font-bold text-xs">{{$order->status}}</span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <button class="px-2 py-1 border bg-green-800 border-green-700 text-white rounded-3xl"><a href="{{route('orders.show',$order->id)}}">View</a></button>


                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{ $orders->links() }}
    </div>
</div>

@endsection