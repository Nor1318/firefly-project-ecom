@extends('../../components/layouts.admin.app')

@section('title', 'View Category - Admin Dashboard')

@section('heading','Categories')

@section('content')


<div class="bg-white rounded-lg shadow">
    <div class="p-4 flex justify-between m-2">
        <h2 class="text-lg font-semibold">Category Details</h2>
        <a href="{{route('categories.index')}}" class="px-4 py-2 bg-blue-800 text-white rounded">Back</a>
    </div>

    <div class="p-6">
        <div class="space-y-4">
            <div class="pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Category ID</label>
                <p class="text-sm text-gray-900">{{$category->id}}</p>
            </div>

            <div class="pb-4">
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Name</label>
                <p class="text-sm text-gray-900">{{$category->name}}</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Slug</label>
                <p class="text-sm text-gray-900">{{$category->slug}}</p>
            </div>


        </div>

        <div class="flex gap-2 mt-6 pt-4 ">
            <button class="px-4 py-2 bg-yellow-600 text-white rounded"><a href="{{route('categories.edit',$category->id)}}">Edit</a></button>

        </div>
    </div>
</div>

@endsection