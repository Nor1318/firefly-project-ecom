@extends('components/layouts.app')

@section('content')

@if(session('success'))
<div class="fixed top-6 right-6 z-50 max-w-sm w-full transition-all duration-500 transform translate-y-0 opacity-100">
    <div class="bg-green-50 border-l-4 border-green-500 rounded-lg shadow-lg overflow-hidden">
        <div class="p-4 flex items-start gap-3">
            <!-- Icon -->
            <div class="flex-shrink-0 text-green-500">
                <i class="ph-bold ph-check-circle text-2xl"></i>
            </div>
            <!-- Text -->
            <div class="w-full">
                <h3 class="text-sm font-bold text-green-900">Success</h3>
                <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
            </div>
            <!-- Close Button -->
            <button onclick="this.closest('.fixed').style.display='none'" class="text-green-500 hover:text-green-800 transition">
                <i class="ph-bold ph-x"></i>
            </button>
        </div>
    </div>
</div>
@endif

<section class="bg-white border-b border-gray-200 pt-12 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{route('user.products')}}" method="GET">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">

                <div>
                    <h1 class="text-3xl font-bold text-gray-900">All Products</h1>
                    <p class="text-sm text-gray-500 mt-1">Showing {{count($products)}} results</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 items-end sm:items-center">
                    <div class="relative group w-full sm:w-auto">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ph ph-tag text-gray-400"></i>
                        </div>

                        <select name="category" class="appearance-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full sm:w-48 pl-10 p-2.5 cursor-pointer hover:bg-gray-100 transition">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="ph-bold ph-caret-down text-gray-500"></i>
                        </div>
                    </div>
                    <button type="submit" class="bg-gray-900 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-primary transition w-full sm:w-auto">
                        Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Grid Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            @foreach($products as $product)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 group overflow-hidden border border-gray-100 flex flex-col h-full">


                <div class="relative aspect-[3/4] overflow-hidden bg-gray-200">
                    <a href="{{ route('user.product.show', $product->id) }}" class="block w-full h-full">
                        <img src="/storage/{{$product->image}}"
                            alt="{{$product->name}}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </a>
                </div>

                <!-- Content Area -->
                <div class="p-5 flex flex-col flex-grow">
                    <!-- Category & Title -->
                    <div class="mb-4">
                        <p class="text-xs font-medium text-gray-500 mb-1 uppercase tracking-wide">{{$product->category->name}}</p>


                        <a href="{{ route('products.show', $product->id) }}" class="text-base font-bold text-gray-900 hover:text-primary transition line-clamp-2">
                            {{$product->name}}
                        </a>
                    </div>


                    <div class="mt-auto">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-lg font-bold text-primary">Rs {{$product->price}}</span>
                            <span class="text-xs text-green-600 font-medium bg-green-50 px-2 py-1 rounded">In Stock</span>
                        </div>

                        <a href="{{route('cart.add', $product->id)}}"
                            class="w-full flex items-center justify-center gap-2 bg-gray-900 hover:bg-primary text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-200 shadow-sm hover:shadow">
                            <i class="ph-bold ph-shopping-bag"></i>
                            Add to Cart
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $products->links() }}
        </div>

    </div>
</section>

@endsection