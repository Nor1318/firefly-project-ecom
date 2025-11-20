@extends('../../components/layouts.admin.app')

@section('title', 'Product - Admin Dashboard')

@section('heading','Product')

@section('content')

<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">Product List</h2>
        <button class="px-4 py-2 bg-blue-800 text-white rounded"><a href="{{route('products.create')}}">Add Product</a></button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($products as $product)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$product->id}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        @if($product->image)
                        <img src="/storage/{{$product->image}}" alt="Product" class="w-12 h-12  rounded">
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$product->name}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$product->category->name}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$product->price}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$product->quantity}}</td>
                    <td class="px-6 py-4 text-sm flex gap-2">
                        <a href="{{route('products.show',$product->id)}}" class="px-2 py-1 border bg-green-800 border-green-700 text-white rounded-3xl">View</a>
                        <a href="{{route('products.edit',$product->id)}}" class="px-2 py-1 border bg-yellow-800 border-yellow-700 text-white rounded-3xl">Edit</a>
                        <form action="{{route('products.destroy',$product->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="px-2 py-1 border bg-red-800 border-red-700 text-white rounded-3xl">Delete</button>
                        </form>
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection