@extends('../../components/layouts.admin.app')

@section('title', 'User Details - Admin Dashboard')

@section('heading','User')

@section('content')

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">User Details</h2>
            <p class="text-sm text-gray-500 mt-1">View user account information</p>
        </div>
        <div class="flex gap-3">
            <a href="{{route('users.index')}}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                Back to List
            </a>
            <a href="{{route('users.edit', $user->id)}}" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition-colors">
                Edit User
            </a>
        </div>
    </div>

    <div class="p-6 max-w-3xl">
        <div class="bg-gray-50 rounded-lg border border-gray-100 p-6 space-y-8">
            {{-- User Header --}}
            <div class="flex items-center gap-4 border-b border-gray-200 pb-6">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center text-2xl font-bold text-purple-600">
                    {{substr($user->name, 0, 1)}}
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">{{$user->name}}</h3>
                    <p class="text-gray-500">{{$user->email}}</p>
                </div>
                <div class="ml-auto">
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{$user->role == 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800'}}">
                        {{ucfirst($user->role)}}
                    </span>
                </div>
            </div>

            {{-- User Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <p class="text-sm text-gray-500">User ID</p>
                    <p class="text-lg font-semibold text-gray-900">#{{$user->id}}</p>
                </div>
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <p class="text-sm text-gray-500">Joined Date</p>
                    <p class="text-lg font-semibold text-gray-900">{{$user->created_at->format('M d, Y')}}</p>
                </div>
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <p class="text-sm text-gray-500">Email Verified</p>
                    <p class="text-lg font-semibold {{$user->email_verified_at ? 'text-green-600' : 'text-yellow-600'}}">
                        {{$user->email_verified_at ? 'Verified' : 'Pending'}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection