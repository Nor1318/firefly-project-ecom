@extends('../../components/layouts.admin.app')

@section('title', 'Product Details - Admin Dashboard')

@section('heading','Product')

@section('content')

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Product Details</h2>
            <p class="text-sm text-gray-500 mt-1">View product information</p>
        </div>
        <div class="flex gap-3">
            <a href="{{route('products.index')}}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                Back to List
            </a>
            <a href="{{route('products.edit', $product->id)}}" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition-colors">
                Edit Product
            </a>
        </div>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Image Column --}}
            <div class="md:col-span-1">
                @if($product->image)
                <img src="/storage/{{$product->image}}" alt="{{$product->name}}" class="w-full rounded-lg border border-gray-200 shadow-sm">
                @else
                <div class="w-full aspect-square bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                    <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                @endif
            </div>

            {{-- Details Column --}}
            <div class="md:col-span-2 space-y-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">{{$product->name}}</h3>
                    <p class="text-sm text-gray-500 mt-1">Slug: {{$product->slug}}</p>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <p class="text-sm font-medium text-gray-500">Price</p>
                        <p class="text-xl font-bold text-gray-900 mt-1">Rs {{number_format($product->price, 2)}}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <p class="text-sm font-medium text-gray-500">Stock</p>
                        <p class="text-xl font-bold text-gray-900 mt-1">{{$product->quantity}} units</p>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Category</h4>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                        {{$product->category->name}}
                    </span>
                </div>

                <div>
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Description</h4>
                    <div class="prose prose-sm max-w-none text-gray-600 bg-gray-50 p-4 rounded-lg border border-gray-100">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection