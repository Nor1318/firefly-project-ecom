@extends('../../components/layouts.admin.app')

@section('title', 'Category Details - Admin Dashboard')

@section('heading','Category')

@section('content')

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Category Details</h2>
            <p class="text-sm text-gray-500 mt-1">View category information</p>
        </div>
        <div class="flex gap-3">
            <a href="{{route('categories.index')}}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                Back to List
            </a>
            <a href="{{route('categories.edit', $category->id)}}" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition-colors">
                Edit Category
            </a>
        </div>
    </div>

    <div class="p-6 max-w-2xl">
        <div class="bg-gray-50 rounded-lg border border-gray-100 p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Category ID</label>
                    <p class="text-gray-900 font-medium">#{{$category->id}}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Created At</label>
                    <p class="text-gray-900">{{$category->created_at->format('M d, Y')}}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
                    <p class="text-gray-900 font-bold text-lg">{{$category->name}}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Slug</label>
                    <p class="text-gray-900 font-mono text-sm bg-white px-2 py-1 rounded border border-gray-200 inline-block">{{$category->slug}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection