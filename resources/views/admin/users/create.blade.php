@extends('../../components/layouts.admin.app')

@section('title', 'Create User - Admin Dashboard')

@section('heading','Users')

@section('content')



<div class="bg-white rounded-lg shadow">
    <div class="p-4 border-b flex justify-between m-2">
        <h2 class="text-lg font-semibold">Add New User</h2>
        <button class="px-4 py-2 bg-blue-800 text-white rounded"><a href="{{route('users.index')}}">Back</a></button>
    </div>

    <div class="p-6">
        <form action="{{route('users.store')}}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Name</label>
                <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded " placeholder="Enter user name">
                @error('name')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded " placeholder="Enter user email">
                @error('email')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded " placeholder="Enter Password">
                @error('password')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded " placeholder="Re-enter Password">
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-500 uppercase mb-2">Role</label>
                <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded ">
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                @error('role')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>



            <div class="flex gap-2 pt-4 ">
                <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded">Create User</button>

            </div>
        </form>
    </div>
</div>

@endsection