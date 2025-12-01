@extends('components.layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-3xl shadow-xl border border-gray-100">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Welcome Back! 👋</h2>
            <p class="mt-2 text-sm text-gray-600">
                Sign in to access your account and orders
            </p>
        </div>
        
        <form class="mt-8 space-y-6" method="post" action="{{route('login')}}">
            @csrf
            
            <div class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ph-bold ph-envelope text-gray-400"></i>
                        </div>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="appearance-none relative block w-full px-3 py-3 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-xl focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm transition" 
                            placeholder="you@example.com">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{$message}}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ph-bold ph-lock-key text-gray-400"></i>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                            class="appearance-none relative block w-full px-3 py-3 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-xl focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm transition" 
                            placeholder="••••••••">
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end">
                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="font-medium text-primary hover:text-purple-700 transition">
                        Forgot your password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-primary hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform duration-200">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="ph-bold ph-sign-in text-purple-300 group-hover:text-purple-200"></i>
                    </span>
                    Sign in
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <p class="text-sm text-gray-600">
                Don't have an account?
                <a href="{{route('register.show')}}" class="font-bold text-primary hover:text-purple-700 transition">Create one now</a>
            </p>
        </div>
    </div>
</div>
@endsection