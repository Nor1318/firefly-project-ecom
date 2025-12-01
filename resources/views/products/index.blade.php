@extends('components.layouts.app')

@section('content')

@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
     class="fixed top-24 right-6 z-50 max-w-sm w-full bg-green-50 border-l-4 border-green-500 rounded-lg shadow-lg overflow-hidden transition-all duration-500">
    <div class="p-4 flex items-start gap-3">
        <div class="flex-shrink-0 text-green-500">
            <i class="ph-bold ph-check-circle text-2xl"></i>
        </div>
        <div class="w-full">
            <h3 class="text-sm font-bold text-green-900">Added to Cart</h3>
            <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
        </div>
        <button @click="show = false" class="text-green-500 hover:text-green-800">
            <i class="ph-bold ph-x"></i>
        </button>
    </div>
</div>
@endif

<section class="bg-secondary/30 border-b border-purple-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Shop</h1>
                <p class="text-gray-600 mt-1">Find the perfect items for your little one</p>
            </div>
            
            <!-- Sort By (Mobile & Desktop) -->
            <form id="sortForm" action="{{route('user.products')}}" method="GET" class="flex items-center gap-2">
                @foreach(request()->except(['sort_by', 'page']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <label for="sort_by" class="text-sm font-medium text-gray-700 whitespace-nowrap">Sort by:</label>
                <select name="sort_by" onchange="document.getElementById('sortForm').submit()" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block p-2.5 outline-none cursor-pointer hover:border-primary transition">
                    <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Newest First</option>
                    <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                </select>
            </form>
        </div>
    </div>
</section>

<section class="py-12 min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-1/4 flex-shrink-0">
                <form action="{{route('user.products')}}" method="GET" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    @if(request('q'))
                        <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif
                    @if(request('sort_by'))
                        <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                    @endif

                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-gray-900">Filters</h3>
                        @if(request('category') || request('min_price') || request('max_price') || request('q'))
                        <a href="{{route('user.products')}}" class="text-xs text-red-500 hover:text-red-700 font-medium">Clear All</a>
                        @endif
                    </div>

                    <!-- Categories -->
                    <div class="mb-8">
                        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Categories</h4>
                        <div class="space-y-2">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                <span class="text-gray-600 group-hover:text-primary transition">All Categories</span>
                            </label>
                            @foreach($categories as $category)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="category" value="{{$category->id}}" {{ request('category') == $category->id ? 'checked' : '' }} class="w-4 h-4 text-primary border-gray-300 focus:ring-primary">
                                <span class="text-gray-600 group-hover:text-primary transition">{{$category->name}}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-8">
                        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Price Range</h4>
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500 text-sm">Rs</span>
                                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary outline-none">
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500 text-sm">Rs</span>
                                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-primary focus:border-primary outline-none">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl font-bold hover:bg-purple-700 transition shadow-md hover:shadow-lg">
                        Apply Filters
                    </button>
                </form>
            </aside>

            <!-- Product Grid -->
            <div class="w-full lg:w-3/4">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                        <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl transition-all duration-300 group flex flex-col h-full border border-gray-100">
                            
                            <!-- Image -->
                            <div class="relative aspect-square rounded-xl overflow-hidden bg-gray-100 mb-4">
                                <a href="{{ route('user.product.show', $product->id) }}" class="block w-full h-full">
                                    <img src="/storage/{{$product->image}}"
                                        alt="{{$product->name}}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </a>
                                
                                @if($product->quantity < 1)
                                <div class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                                    Sold Out
                                </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="flex flex-col flex-grow">
                                <p class="text-xs text-gray-500 mb-1 uppercase tracking-wider">{{$product->category->name}}</p>
                                <a href="{{ route('user.product.show', $product->id) }}">
                                    <h3 class="font-bold text-gray-900 text-lg mb-2 hover:text-primary transition line-clamp-1">{{$product->name}}</h3>
                                </a>
                                
                                <div class="mt-auto pt-4">
                                    <div class="mb-3">
                                        <span class="text-2xl font-bold text-primary">Rs {{$product->price}}</span>
                                    </div>
                                    
                                    @if($product->quantity > 0)
                                    <a href="{{route('cart.add',$product->id)}}" class="w-full bg-gray-900 text-white py-2.5 px-4 rounded-lg text-sm font-bold hover:bg-primary transition flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                                        <i class="ph-bold ph-shopping-cart"></i>
                                        Add to Cart
                                    </a>
                                    @else
                                    <button disabled class="flex-1 bg-gray-200 text-gray-400 py-2 px-4 rounded-lg text-sm font-bold cursor-not-allowed">
                                        Sold Out
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        {{ $products->links() }}
                    </div>
                @else
                    <!-- No Results -->
                    <div class="bg-white rounded-2xl p-12 text-center border border-gray-100 shadow-sm">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-purple-50 mb-6">
                            <i class="ph-duotone ph-magnifying-glass text-4xl text-primary"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">No Products Found</h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">
                            We couldn't find what you're looking for. Try adjusting your search or filters.
                        </p>
                        <a href="{{route('user.products')}}" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-purple-700 transition shadow-md hover:shadow-lg">
                            Clear All Filters
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection