@extends('components/layouts.app')

@section('content')

<!-- Success Notification -->
@if(session('success'))
<div class="fixed top-6 right-6 z-50 max-w-sm w-full transition-all duration-500">
    <div class="bg-green-50 border-l-4 border-green-500 rounded-lg shadow-lg overflow-hidden">
        <div class="p-4 flex items-start gap-3">
            <div class="flex-shrink-0 text-green-500">
                <i class="ph-bold ph-check-circle text-2xl"></i>
            </div>
            <div class="w-full">
                <h3 class="text-sm font-bold text-green-900">Added to Cart</h3>
                <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
            </div>
            <button onclick="this.closest('.fixed').style.display='none'" class="text-green-500 hover:text-green-800">
                <i class="ph-bold ph-x"></i>
            </button>
        </div>
    </div>
</div>

@endif
@if(session('error'))
<div class="fixed top-6 right-6 z-50 max-w-sm w-full transition-all duration-500 animate-bounce-in">
    <div class="bg-red-50 border-l-4 border-red-500 rounded-lg shadow-lg overflow-hidden">
        <div class="p-4 flex items-start gap-3">
            <div class="flex-shrink-0 text-red-500">
                <i class="ph-bold ph-warning-circle text-2xl"></i>
            </div>
            <div class="w-full">
                <h3 class="text-sm font-bold text-red-900">Cannot Add Item</h3>
                <p class="text-sm text-red-700 mt-1">{{ session('error') }}</p>
            </div>
            <button onclick="this.closest('.fixed').style.display='none'" class="text-red-500 hover:text-red-800">
                <i class="ph-bold ph-x"></i>
            </button>
        </div>
    </div>
</div>
@endif

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <nav class="flex text-sm text-gray-500 mb-8">
        <ol class="flex items-center space-x-2">
            <li><a href="{{ route('home') }}" class="hover:text-primary transition">Home</a></li>
            <li><span class="text-gray-300">/</span></li>
            <li><a href="{{ route('user.products') }}" class="hover:text-primary transition">Products</a></li>
            <li><span class="text-gray-300">/</span></li>
            <li class="text-gray-900 font-medium truncate">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-start">

        <!-- Product Image -->
        <div class="w-full bg-gray-100 rounded-2xl overflow-hidden border border-gray-200">
            <div class="aspect-square relative group">
                <img src="/storage/{{$product->image}}"
                    alt="{{$product->name}}"
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
            </div>
        </div>

        <!-- Product Details -->
        <div class="flex flex-col h-full">

            <!-- Category Badge -->
            @if($product->category)
            <div class="mb-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 uppercase tracking-wide">
                    {{ $product->category->name }}
                </span>
            </div>
            @endif

            <!-- Title -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                {{$product->name}}
            </h1>

            <!-- Price & Stock Display -->
            <div class="flex items-center gap-4 mb-6">
                <span class="text-3xl font-bold text-primary">Rs {{$product->price}}</span>
                <div class="h-6 w-px bg-gray-300"></div>

                <!-- Stock Logic -->
                @if($product->quantity > 0)
                @if($product->quantity < 10)
                    <!-- Low Stock (Orange) -->
                    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-orange-700 bg-orange-50 px-2.5 py-1 rounded-md">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-600 animate-pulse"></span>
                        Only {{ $product->quantity }} items remaining
                    </span>
                    @else
                    <!-- Good Stock (Green) -->
                    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-green-700 bg-green-50 px-2.5 py-1 rounded-md">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                        {{ $product->quantity }} Items remaining
                    </span>
                    @endif
                    @else
                    <!-- Out of Stock (Red) -->
                    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-red-700 bg-red-50 px-2.5 py-1 rounded-md">
                        <i class="ph-bold ph-x-circle"></i>
                        Out of Stock
                    </span>
                    @endif
            </div>

            <!-- Description -->
            <div class="prose prose-sm text-gray-600 mb-8 leading-relaxed">
                <p>{{$product->description}}</p>
            </div>

            <div class="mt-auto pt-8 border-t border-gray-100">

                <form action="{{route('cart.add', $product->id)}}" method="get">
                    @csrf
                    <input type="hidden" name="source_page" value="product_show">

                    <!-- Quantity Selector -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                        <div class="flex items-center w-max border border-gray-300 rounded-lg bg-white overflow-hidden">

                            <!-- Minus Button -->
                            <button type="button" onclick="this.nextElementSibling.stepDown()" class="px-4 py-3 text-gray-600 hover:bg-gray-100 transition active:bg-gray-200">
                                <i class="ph-bold ph-minus"></i>
                            </button>

                            <!-- Input -->
                            <!-- FIX 2: Changed name from 'quantity_{id}' to just 'quantity' to match Controller -->
                            <input
                                type="number"
                                name="quantity"
                                value="1"
                                min="1"
                                max="{{ $product->quantity }}"
                                class="w-16 text-center border-x border-gray-300 py-3 text-gray-900 font-semibold focus:outline-none appearance-none">

                            <!-- Plus Button -->
                            <button type="button" onclick="this.previousElementSibling.stepUp()" class="px-4 py-3 text-gray-600 hover:bg-gray-100 transition active:bg-gray-200">
                                <i class="ph-bold ph-plus"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        @if($product->quantity < 1) disabled @endif
                            class="w-full bg-gray-900 hover:bg-primary text-white font-bold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2 disabled:bg-gray-300 disabled:cursor-not-allowed disabled:shadow-none">
                            <i class="ph-bold ph-shopping-bag text-xl"></i>
                            @if($product->quantity < 1) Out of Stock @else Add to Cart @endif
                                </button>
                </form>

            </div>

        </div>
    </div>

</main>
@endsection