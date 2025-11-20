@extends('../../components/layouts.admin.app')

@section('title', 'Categories')

@section('heading','Categories')

@section('content')


<div class="bg-white rounded-lg shadow  ">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">Categories List</h2>
        <button class="px-4 py-2 bg-blue-800 text-white rounded"><a href="{{route('categories.create')}}">Add Category</a></button>
    </div>
    <div>
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white ">
                @foreach($categories as $category)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$category->id}}</td>
                    <td class="px-6 py-4  text-sm text-gray-900">{{$category->name}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$category->slug}}</td>
                    <td class="px-6 py-4 text-sm flex gap-2">
                        <a href="{{route('categories.show',$category->id)}}" class="px-2 py-1 border bg-green-800 border-green-700 text-white rounded-3xl">View</a>
                        <a href="{{route('categories.edit',$category->id)}}" class="px-2 py-1 border bg-yellow-800 border-yellow-700 text-white rounded-3xl">Edit</a>
                        <form action="{{route('categories.destroy',$category->id)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="px-2 py-1 border bg-red-800 border-red-700 text-white rounded-3xl">Delete</button>
                        </form>
                </tr>
                @endforeach


            </tbody>
        </table>
    </div>
</div>

@endsection