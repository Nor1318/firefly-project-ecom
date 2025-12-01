@extends('components.layouts.app')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-3xl shadow-xl border border-gray-100">
        <div class="text-center">
            <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="ph-bold ph-lock-key-open text-3xl text-primary"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Forgot Password? 🔒</h2>
            <p class="mt-2 text-sm text-gray-600">
                No worries! Just enter your email and we'll send you a reset link.
            </p>
        </div>

        @if (session('status'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="ph-bold ph-check-circle text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif
        
        <form class="mt-8 space-y-6" method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="ph-bold ph-envelope text-gray-400"></i>
                    </div>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        class="appearance-none relative block w-full px-3 py-3 pl-10 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-xl focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm transition" 
                        placeholder="you@example.com">
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{$message}}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-xl text-white bg-primary hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform duration-200">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="ph-bold ph-paper-plane-right text-purple-300 group-hover:text-purple-200"></i>
                    </span>
                    Send Reset Link
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <a href="{{route('login.show')}}" class="font-medium text-gray-600 hover:text-primary transition flex items-center justify-center gap-2">
                <i class="ph-bold ph-arrow-left"></i>
                Back to Login
            </a>
        </div>
    </div>
</div>
@endsection
