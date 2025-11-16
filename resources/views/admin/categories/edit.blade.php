@extends('../../components/layouts.admin.app')

@section('title', 'Edit Category - Admin Dashboard')

@section('heading','Category')

@section('content')




<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">Edit Category</h2>
        <a href="{{route('categories.index')}}" class="px-4 py-2 bg-blue-800 text-white rounded">Back</a>
    </div>

    <div class="p-6">
        <form action="{{route('categories.update',$category->id)}}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Name</label>
                <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded" value="{{$category->name}}">
                @error('name')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Slug</label>
                <input type="text" name="slug" class="w-full px-4 py-2 border border-gray-300 rounded" value="{{$category->slug}}">
            </div>

            <div class="flex gap-2 pt-4 ">
                <button type="submit" class="px-4 py-2 bg-yellow-800 text-white rounded">Edit Category</button>
            </div>
        </form>
    </div>
</div>

@endsection