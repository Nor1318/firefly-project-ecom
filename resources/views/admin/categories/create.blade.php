@extends('../../components/layouts.admin.app')

@section('title', 'Create Category - Admin Dashboard')

@section('heading','Category')

@section('content')

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Add New Category</h2>
            <p class="text-sm text-gray-500 mt-1">Create a new product category</p>
        </div>
        <a href="{{route('categories.index')}}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
            Back to List
        </a>
    </div>

    <div class="p-6">
        <form action="{{route('categories.store')}}" method="post" class="space-y-6 max-w-2xl">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" placeholder="Enter category name" value="{{old('name')}}">
                @error('name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                <input type="text" name="slug" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" placeholder="Enter category slug" value="{{old('slug')}}">
                @error('slug')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="px-6 py-2 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                    Create Category
                </button>
            </div>
        </form>
    </div>
</div>

@endsection