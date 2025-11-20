@extends('../../components/layouts.admin.app')

@section('title', 'Users List - Admin Dashboard')

@section('heading','Users')

@section('content')


<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">User List</h2>
        <button class="px-4 py-2 bg-blue-800 text-white rounded"><a href="{{route('users.create')}}">Add User</a></button>
    </div>
    <div class="overflow-x-auto m-5">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($users as $user)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$user->id}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$user->name}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{$user->email}}</td>
                    <td class="px-6 py-4 text-xs text-gray-900 font-bold">{{$user->role}}</td>

                    <td class="px-6 py-4 text-sm">
                        <div class="flex items-center gap-2">
                            <a href="{{route('users.show',$user->id)}}" class="px-2 py-1 border bg-green-800 border-green-700 text-white rounded-3xl">
                                View
                            </a>
                            <a href="{{route('users.edit',$user->id)}}" class="px-2 py-1 border bg-yellow-800 border-yellow-700 text-white rounded-3xl">
                                Edit
                            </a>
                            <form action="{{route('users.destroy', $user->id)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 border bg-red-800 border-red-700 text-white rounded-3xl">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="m">
        {{$users->links()}}
    </div>


</div>

@endsection