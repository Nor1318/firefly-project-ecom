@extends('../../components/layouts.admin.app')

@section('title', 'Edit Product - Admin Dashboard')

@section('heading','Product')

@section('content')
<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">Edit Product</h2>
        <button class="px-4 py-2 bg-blue-800 text-white rounded"><a href="{{route('products.index')}}">Back</a></button>
    </div>

    <div class="p-6">
        <form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Name</label>
                <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded " value="{{$product->name}}">
                @error('name')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Slug</label>
                <input type="text" name="slug" class="w-full px-4 py-2 border border-gray-300 rounded " value="{{$product->slug}}">
                @error('slug')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Category</label>
                <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded ">
                    <option value="{{$product->category_id}}">{{$product->category->name}}</option>
                    @foreach($categories as $category)
                    @if($category->id != $product->category_id)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                    @endforeach

                </select>
                @error('category_id')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Price</label>
                <input type="number" name="price" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded " value="{{$product->price}}">
                @error('price')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Quantity</label>
                <input type="number" name="quantity" class="w-full px-4 py-2 border border-gray-300 rounded " value="{{$product->quantity}}">
                @error('quantity')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>

            <div>
                <label class="block">Image</label>
                @if($product->image)
                <div class="mb-2">
                    <img src="{{asset('storage/' . $product->image)}}" alt="Current image" class="w-32 h-32 object-cover rounded">
                    <p class="text-sm text-gray-500 mt-1">Current image</p>
                </div>
                @endif
                <input type="file" name="image" class="px-4 py-2" accept="image/*">
                <p class="text-xs text-gray-500 font-semibold mt-1">Leave empty to keep current image</p>
                @error('image')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Description</label>
                <textarea name="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded">{{$product->description}}</textarea>
                @error('description')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>

            <div class="flex gap-2 pt-4 ">
                <button type="submit" class="px-4 py-2 bg-yellow-800 text-white rounded">Edit Product</button>

            </div>
        </form>
    </div>
</div>
@endsection