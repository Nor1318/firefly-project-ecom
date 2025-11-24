@extends('components/layouts.app')

@section('content')

<main class="max-w-5xl mx-auto px-4 sm:px-6 py-12">

    <!-- Profile Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

        <!-- Header / Banner Section -->
        <div class="bg-gray-50 p-8 border-b border-gray-100">
            <div class="flex flex-col md:flex-row items-center gap-6">
                <!-- Avatar -->
                <div class="relative">
                    <div class="w-24 h-24 rounded-full bg-white p-1 shadow-md">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff&size=128"
                            alt="{{ Auth::user()->name }}"
                            class="w-full h-full rounded-full object-cover">
                    </div>
                </div>

                <!-- Name & Email -->
                <div class="text-center md:text-left flex-grow">
                    <h1 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h1>
                    <p class="text-gray-500 font-medium">{{ Auth::user()->email }}</p>
                    <div class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                        Member since {{ Auth::user()->created_at->format('F Y') }}
                    </div>
                </div>

                <!-- Edit Button -->
                <div>
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 text-sm font-medium hover:bg-gray-50 transition shadow-sm">
                        Edit Profile
                    </button>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-gray-100">

            <!-- Left Column: Personal Information -->
            <div class="col-span-2 p-8 space-y-6">
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <i class="ph-duotone ph-user text-primary text-xl"></i>
                    Personal Information
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Full Name</label>
                        <p class="text-gray-900 font-medium">{{ Auth::user()->name }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Email Address</label>
                        <p class="text-gray-900 font-medium">{{ Auth::user()->email }}</p>
                    </div>

                    <!-- UPDATED: Role Section -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Role</label>
                        <p class="text-gray-900 font-medium capitalize">
                            <!-- This checks if a 'role' exists in DB, otherwise defaults to 'User' -->
                            {{ Auth::user()->role ?? 'User' }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Account ID</label>
                        <p class="text-gray-900 font-medium font-mono">#{{ Auth::user()->id }}</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Quick Actions -->
            <div class="col-span-1 p-8 bg-gray-50/30">
                <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <i class="ph-duotone ph-gear text-primary text-xl"></i>
                    Menu
                </h3>

                <div class="space-y-3">
                    <!-- My Orders -->
                    <a href="{{ route('order.index') }}" class="group flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200 hover:border-primary hover:shadow-md transition-all duration-200">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <i class="fas fa-shopping-bag text-sm"></i>
                            </div>
                            <span class="text-gray-700 font-medium group-hover:text-gray-900">My Orders</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-300 group-hover:text-primary"></i>
                    </a>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="group flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200 hover:border-primary hover:shadow-md transition-all duration-200">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-green-50 text-green-600 flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition-colors">
                                <i class="fas fa-shopping-cart text-sm"></i>
                            </div>
                            <span class="text-gray-700 font-medium group-hover:text-gray-900">My Cart</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-300 group-hover:text-primary"></i>
                    </a>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="mt-6 pt-6 border-t border-gray-200">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 p-3 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition font-medium">
                            <i class="fas fa-sign-out-alt"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection