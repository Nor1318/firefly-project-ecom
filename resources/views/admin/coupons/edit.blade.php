@extends('../../components/layouts.admin.app')

@section('title', 'Edit Coupon - Admin Dashboard')

@section('heading','Edit Coupon')

@section('content')

<div class="max-w-3xl">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Edit Coupon</h2>
            <p class="text-sm text-gray-500 mt-1">Update coupon details</p>
        </div>

        <form action="{{route('coupons.update', $coupon->id)}}" method="POST" class="p-6 space-y-6" x-data="{ type: '{{ $coupon->type }}' }">
            @csrf
            @method('PUT')

            {{-- Usage Stats Alert --}}
            @if($coupon->used_count > 0)
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="text-sm font-medium text-blue-900">This coupon has been used {{$coupon->used_count}} time(s)</h4>
                        <p class="text-xs text-blue-700 mt-1">Be careful when modifying active coupons that have already been used.</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- Code --}}
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700 mb-2">Coupon Code *</label>
                <input type="text" name="code" id="code" value="{{old('code', $coupon->code)}}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent uppercase font-mono {{ $coupon->used_count > 0 ? 'bg-gray-50' : '' }}"
                    placeholder="e.g., WELCOME10" required {{ $coupon->used_count > 0 ? 'readonly' : '' }}>
                @if($coupon->used_count > 0)
                    <p class="mt-1 text-xs text-gray-500">Code cannot be changed after coupon has been used</p>
                @endif
                @error('code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Discount Type *</label>
                <div class="flex gap-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="type" value="percentage" x-model="type" class="w-4 h-4 text-purple-600 focus:ring-purple-500" {{ $coupon->type === 'percentage' ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">Percentage (%)</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="type" value="fixed" x-model="type" class="w-4 h-4 text-purple-600 focus:ring-purple-500" {{ $coupon->type === 'fixed' ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-700">Fixed Amount (Rs)</span>
                    </label>
                </div>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Value --}}
            <div>
                <label for="value" class="block text-sm font-medium text-gray-700 mb-2">
                    Discount Value *
                    <span x-show="type === 'percentage'" class="text-gray-500">(0-100%)</span>
                    <span x-show="type === 'fixed'" class="text-gray-500">(in Rs)</span>
                </label>
                <div class="relative">
                    <input type="number" name="value" id="value" value="{{old('value', $coupon->value)}}" step="0.01" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        placeholder="10" required>
                    <span x-show="type === 'percentage'" class="absolute right-3 top-2.5 text-gray-500">%</span>
                    <span x-show="type === 'fixed'" class="absolute right-3 top-2.5 text-gray-500">Rs</span>
                </div>
                @error('value')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Min Order Amount --}}
            <div>
                <label for="min_order_amount" class="block text-sm font-medium text-gray-700 mb-2">Minimum Order Amount (Optional)</label>
                <div class="relative">
                    <input type="number" name="min_order_amount" id="min_order_amount" value="{{old('min_order_amount', $coupon->min_order_amount)}}" step="0.01" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        placeholder="500">
                    <span class="absolute right-3 top-2.5 text-gray-500">Rs</span>
                </div>
                <p class="mt-1 text-xs text-gray-500">Leave empty for no minimum order requirement</p>
                @error('min_order_amount')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Usage Limit --}}
            <div>
                <label for="usage_limit" class="block text-sm font-medium text-gray-700 mb-2">Usage Limit (Optional)</label>
                <input type="number" name="usage_limit" id="usage_limit" value="{{old('usage_limit', $coupon->usage_limit)}}" min="1"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    placeholder="100">
                <p class="mt-1 text-xs text-gray-500">Leave empty for unlimited usage. Current usage: {{$coupon->used_count}}</p>
                @error('usage_limit')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Valid From --}}
            <div>
                <label for="valid_from" class="block text-sm font-medium text-gray-700 mb-2">Valid From (Optional)</label>
                <input type="date" name="valid_from" id="valid_from" value="{{old('valid_from', $coupon->valid_from ? $coupon->valid_from->format('Y-m-d') : '')}}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <p class="mt-1 text-xs text-gray-500">Leave empty to start immediately</p>
                @error('valid_from')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Valid Until --}}
            <div>
                <label for="valid_until" class="block text-sm font-medium text-gray-700 mb-2">Valid Until (Optional)</label>
                <input type="date" name="valid_until" id="valid_until" value="{{old('valid_until', $coupon->valid_until ? $coupon->valid_until->format('Y-m-d') : '')}}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <p class="mt-1 text-xs text-gray-500">Leave empty for no expiration</p>
                @error('valid_until')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Active Status --}}
            <div>
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="w-4 h-4 text-purple-600 focus:ring-purple-500 rounded" {{ $coupon->is_active ? 'checked' : '' }}>
                    <span class="ml-2 text-sm font-medium text-gray-700">Active (coupon can be used)</span>
                </label>
                @error('is_active')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex gap-3 pt-4 border-t border-gray-200">
                <button type="submit" class="px-6 py-2 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors">
                    Update Coupon
                </button>
                <a href="{{route('coupons.index')}}" class="px-6 py-2 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
