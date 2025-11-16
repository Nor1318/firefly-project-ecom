@extends('../../components/layouts.admin.app')

@section('title', 'View Product - Admin Dashboard')

@section('heading','Product')

@section('content')



<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">Product Details</h2>
        <button onclick="history.back()" class="px-4 py-2 bg-blue-800 text-white rounded">Back</button>
    </div>

    <div class="p-6">
        <div class="space-y-4">
            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Product ID</label>
                <p class="text-sm text-gray-900">{{$product->id}}</p>
            </div>
            @if($product->image)
            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Image</label>
                <img src="/storage/{{$product->image}}" alt="Product" class="w-32 h-32 object-cover rounded">
            </div>
            @endif
            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Name</label>
                <p class="text-sm text-gray-900">{{$product->name}}</p>
            </div>

            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Slug</label>
                <p class="text-sm text-gray-900">{{$product->slug}}</p>
            </div>

            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Category</label>
                <p class="text-sm text-gray-900">{{$product->category->name}}</p>
            </div>

            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Price</label>
                <p class="text-sm text-gray-900">{{$product->price}}</p>
            </div>

            <div class=" pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Quantity</label>
                <p class="text-sm text-gray-900">{{$product->quantity}}</p>
            </div>
            @if($product->description)
            <div class="pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Description</label>
                <p class="text-m text-gray-900">{{$product->description}}</p>
            </div>
            @endif
        </div>

        <div class="flex gap-2 mt-6 pt-4">
            <button class="px-4 py-2 bg-yellow-700 text-white rounded"><a href="{{route('products.edit',$product->id)}}">Edit</a></button>

        </div>
    </div>
</div>
@endsection