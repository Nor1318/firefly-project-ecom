@extends('../../components/layouts.admin.app')

@section('title', 'Coupons - Admin Dashboard')

@section('heading','Coupons')

@section('content')

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    {{-- Header --}}
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Coupon Codes</h2>
            <p class="text-sm text-gray-500 mt-1">Manage discount coupons and track usage</p>
        </div>
        <div class="flex gap-3">
            <a href="{{route('coupons.create')}}" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Coupon
            </a>
        </div>
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
