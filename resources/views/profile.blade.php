@extends('components/layouts.app')

@section('content')


<body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Profile Header -->
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzgWDK2u9Gnc4JXoRai1dvYR-5l-xtrDSnfQ&s" alt="">
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h2>
                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <!-- Profile Information -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile Information</h3>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                                <p class="mt-1 text-gray-900">{{ Auth::user()->name }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Address</label>
                                <p class="mt-1 text-gray-900">{{ Auth::user()->email }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Member Since</label>
                                <p class="mt-1 text-gray-900">{{ Auth::user()->created_at->format('F j, Y') }}</p>
                            </div>
                        </div>

                        <!-- Edit Profile Button -->


                        <!-- Account Actions -->
                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Actions</h3>

                            <div class="space-y-3">
                                <a href="{{ route('order.index') }}" class="block p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                    <i class="fas fa-shopping-bag mr-2 text-gray-600"></i>
                                    <span class="text-gray-900">My Orders</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection