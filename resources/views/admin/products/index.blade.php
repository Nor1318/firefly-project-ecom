@extends('../../components/layouts.admin.app')

@section('title', 'Products - Admin Dashboard')

@section('heading','Products')

@section('content')

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    {{-- Header --}}
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Products list</h2>
                <p class="text-sm text-gray-500 mt-1">Manage your baby products inventory</p>
            </div>
            <div class="flex gap-3">
                <a href="{{route('products.create')}}" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Product
                </a>
            </div>
        </div>

        {{-- Search & Filters --}}
        <form action="{{route('products.index')}}" method="GET" class="mt-6 flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="q" value="{{request('q')}}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-purple-500 focus:border-purple-500 sm:text-sm" placeholder="Search products...">
                </div>
            </div>
            <div class="w-full md:w-48">
                <select name="category_id" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-lg">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}" {{request('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-48">
                <select name="stock_status" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-lg">
                    <option value="">All Stock Status</option>
                    <option value="in_stock" {{request('stock_status') == 'in_stock' ? 'selected' : ''}}>In Stock</option>
                    <option value="low_stock" {{request('stock_status') == 'low_stock' ? 'selected' : ''}}>Low Stock (< 10)</option>
                    <option value="out_of_stock" {{request('stock_status') == 'out_of_stock' ? 'selected' : ''}}>Out of Stock</option>
                </select>
            </div>
            <div class="w-full md:w-48">
                <select name="sort_by" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-lg">
                    <option value="">Sort By</option>
                    <option value="price_asc" {{request('sort_by') == 'price_asc' ? 'selected' : ''}}>Price: Low to High</option>
                    <option value="price_desc" {{request('sort_by') == 'price_desc' ? 'selected' : ''}}>Price: High to Low</option>
                    <option value="name" {{request('sort_by') == 'name' ? 'selected' : ''}}>Name: A-Z</option>
                    <option value="newest" {{request('sort_by') == 'newest' ? 'selected' : ''}}>Newest First</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition-colors">
                    Search
                </button>
                @if(request()->hasAny(['q', 'category_id', 'stock_status', 'sort_by']))
                <a href="{{route('products.index')}}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    Clear
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200 bg-gray-50">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($product->image)
                            <img src="/storage/{{$product->image}}" alt="{{$product->name}}" class="w-10 h-10 rounded-lg object-cover mr-3">
                            @else
                            <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center mr-3">
                                <span class="text-purple-600 font-semibold text-sm">{{substr($product->name, 0, 1)}}</span>
                            </div>
                            @endif
                            <span class="text-sm font-medium text-gray-900">{{$product->name}}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-600">{{$product->category->name}}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm font-medium text-gray-900">Rs {{number_format($product->price, 2)}}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-sm text-gray-600">{{$product->quantity}}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex items-center gap-2">
                            <a href="{{route('products.show',$product->id)}}" class="text-purple-600 hover:text-purple-900 font-medium">Details</a>
                            <a href="{{route('products.edit',$product->id)}}" class="text-gray-600 hover:text-gray-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{route('products.destroy',$product->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $products->links() }}
    </div>
</div>

@endsection