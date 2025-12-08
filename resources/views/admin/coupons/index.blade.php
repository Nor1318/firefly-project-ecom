@extends('../../components/layouts.admin.app')

@section('title', 'Coupons - Admin Dashboard')

@section('heading','Coupons')

@section('content')

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    {{-- Header --}}
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Coupon Codes</h2>
                <p class="text-sm text-gray-500 mt-1">Manage discount coupons and track usage</p>
            </div>
            <a href="{{route('coupons.create')}}" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Coupon
            </a>
        </div>

        {{-- Search & Filters --}}
        <form action="{{route('coupons.index')}}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="q" value="{{request('q')}}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 sm:text-sm" placeholder="Search by coupon code...">
                </div>
            </div>
            <div class="w-full md:w-40">
                <select name="type" class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-lg">
                    <option value="">All Types</option>
                    <option value="percentage" {{request('type') == 'percentage' ? 'selected' : ''}}>Percentage</option>
                    <option value="fixed" {{request('type') == 'fixed' ? 'selected' : ''}}>Fixed Amount</option>
                </select>
            </div>
            <div class="w-full md:w-40">
                <select name="status" class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-lg">
                    <option value="">All Status</option>
                    <option value="active" {{request('status') == 'active' ? 'selected' : ''}}>Active</option>
                    <option value="expired" {{request('status') == 'expired' ? 'selected' : ''}}>Expired</option>
                    <option value="used_up" {{request('status') == 'used_up' ? 'selected' : ''}}>Used Up</option>
                </select>
            </div>
            <div class="w-full md:w-44">
                <select name="sort_by" class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-lg">
                    <option value="">Sort By</option>
                    <option value="discount_desc" {{request('sort_by') == 'discount_desc' ? 'selected' : ''}}>Discount High-Low</option>
                    <option value="discount_asc" {{request('sort_by') == 'discount_asc' ? 'selected' : ''}}>Discount Low-High</option>
                    <option value="expiring_soon" {{request('sort_by') == 'expiring_soon' ? 'selected' : ''}}>Expiring Soon</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition-colors flex items-center justify-center whitespace-nowrap">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Search
            </button>
            @if(request('q') || request('type') || request('status') || request('sort_by'))
            <a href="{{route('coupons.index')}}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors flex items-center justify-center whitespace-nowrap">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Clear
            </a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Min Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usage</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valid Until</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($coupons as $coupon)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-bold text-purple-600 font-mono">{{$coupon->code}}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $coupon->type === 'percentage' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst($coupon->type) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-medium text-gray-900">
                            @if($coupon->type === 'percentage')
                                {{$coupon->value}}%
                            @else
                                Rs {{number_format($coupon->value, 2)}}
                            @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-600">
                            @if($coupon->min_order_amount)
                                Rs {{number_format($coupon->min_order_amount, 2)}}
                            @else
                                <span class="text-gray-400">No minimum</span>
                            @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium text-gray-900">{{$coupon->used_count}}</span>
                            <span class="text-sm text-gray-400">/</span>
                            <span class="text-sm text-gray-600">
                                @if($coupon->usage_limit)
                                    {{$coupon->usage_limit}}
                                @else
                                    <span class="text-gray-400">∞</span>
                                @endif
                            </span>
                            @if($coupon->usage_limit)
                                <div class="ml-2 w-16 bg-gray-200 rounded-full h-1.5">
                                    <div class="bg-purple-600 h-1.5 rounded-full" style="width: {{ min(100, ($coupon->used_count / $coupon->usage_limit) * 100) }}%"></div>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-600">
                            @if($coupon->valid_until)
                                {{ $coupon->valid_until->format('M d, Y') }}
                            @else
                                <span class="text-gray-400">No expiry</span>
                            @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $now = now();
                            $isExpired = $coupon->valid_until && $now->gt($coupon->valid_until);
                            $isUpcoming = $coupon->valid_from && $now->lt($coupon->valid_from);
                            $isLimitReached = $coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit;
                        @endphp
                        
                        @if(!$coupon->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Inactive
                            </span>
                        @elseif($isExpired)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Expired
                            </span>
                        @elseif($isLimitReached)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                Limit Reached
                            </span>
                        @elseif($isUpcoming)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Upcoming
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex items-center gap-2">
                            <a href="{{route('coupons.edit',$coupon->id)}}" class="text-gray-600 hover:text-gray-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{route('coupons.destroy',$coupon->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this coupon?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $coupons->links() }}
    </div>
</div>

@endsection
