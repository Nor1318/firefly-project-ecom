@extends('../../components/layouts.admin.app')

@section('title', 'Orders - Admin Dashboard')

@section('heading','Orders')

@section('content')

{{-- Success Message --}}
@if(session('success'))
<div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center justify-between">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    <button onclick="this.parentElement.remove()" class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-200">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
    </button>
</div>
@endif

<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
    {{-- Header --}}
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Orders List</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage customer orders</p>
            </div>
        </div>

        {{-- Search & Filters --}}
        <form action="{{route('orders.index')}}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="q" value="{{request('q')}}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg leading-5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-purple-500 focus:border-purple-500 sm:text-sm" placeholder="Search by order ID or customer name...">
                </div>
            </div>
            <div class="w-full md:w-40">
                <select name="status" class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-lg">
                    <option value="">All Status</option>
                    <option value="pending" {{request('status') == 'pending' ? 'selected' : ''}}>Pending</option>
                    <option value="completed" {{request('status') == 'completed' ? 'selected' : ''}}>Completed</option>
                    <option value="cancelled" {{request('status') == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                </select>
            </div>
            <div class="w-full md:w-44">
                <select name="sort_by" class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-lg">
                    <option value="">Sort By</option>
                    <option value="amount_desc" {{request('sort_by') == 'amount_desc' ? 'selected' : ''}}>Amount High-Low</option>
                    <option value="amount_asc" {{request('sort_by') == 'amount_asc' ? 'selected' : ''}}>Amount Low-High</option>
                    <option value="oldest" {{request('sort_by') == 'oldest' ? 'selected' : ''}}>Oldest First</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 focus:ring-purple-500 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Search
                </button>
                @if(request('q') || request('status') || request('sort_by'))
                <a href="{{route('orders.index')}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 focus:ring-purple-500 transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Clear
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Order ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Address</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($orders as $order)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 dark:bg-gray-900/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">#{{$order->id}}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-600 dark:text-gray-400 dark:text-gray-500">{{$order->user->name}}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-600 dark:text-gray-400 dark:text-gray-500">ID: {{$order->address->id}}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($order->status == 'completed')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Completed
                        </span>
                        @elseif($order->status == 'pending')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                        @elseif($order->status == 'processing')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Processing
                        </span>
                        @else
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            {{ucfirst($order->status)}}
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex items-center gap-2">
                            <a href="{{route('orders.show',$order->id)}}" class="text-purple-600 dark:text-purple-400 hover:text-purple-900 dark:hover:text-purple-300 font-medium">View</a>
                            <span class="text-gray-300">|</span>
                            <a href="{{route('orders.invoice.download', $order)}}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 font-medium" title="Download Invoice">
                                <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </a>
                            <form action="{{route('orders.invoice.email', $order)}}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 font-medium" title="Email Invoice">
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
        {{ $orders->links() }}
    </div>
</div>

@endsection