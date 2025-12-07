@extends('components/layouts.app')

@section('content')

<!-- Success Notification -->
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

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Breadcrumbs -->
    <nav class="flex text-sm text-gray-500 mb-8">
        <ol class="flex items-center space-x-2">
            <li><a href="{{ route('home') }}" class="hover:text-primary transition">Home</a></li>
            <li><i class="ph-bold ph-caret-right text-xs"></i></li>
            <li><a href="{{ route('user.products') }}" class="hover:text-primary transition">Shop</a></li>
            <li><i class="ph-bold ph-caret-right text-xs"></i></li>
            <li class="text-gray-900 font-medium truncate">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-start">

        <!-- Product Image -->
        <div class="w-full bg-gray-50 rounded-3xl overflow-hidden border border-gray-100 shadow-sm">
            <div class="aspect-square relative group">
                <img src="/storage/{{$product->image}}"
                    alt="{{$product->name}}"
                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
            </div>
        </div>

        <!-- Product Details -->
        <div class="flex flex-col h-full" x-data="{ 
            qty: 1, 
            max: {{ $availableQty }},
            increment() { if(this.qty < this.max) this.qty++ },
            decrement() { if(this.qty > 1) this.qty-- }
        }">

            <!-- Category Badge -->
            @if($product->category)
            <div class="mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-50 text-primary uppercase tracking-wide">
                    {{ $product->category->name }}
                </span>
            </div>
            @endif

            <!-- Title -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                {{$product->name}}
            </h1>

            <!-- Price & Stock -->
            <div class="flex items-center gap-4 mb-8">
                <span class="text-3xl font-bold text-primary">Rs {{$product->price}}</span>
                <div class="h-6 w-px bg-gray-200"></div>

                <!-- Stock Logic -->
                @if($product->quantity > 0)
                    @if($product->quantity < 10)
                    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-orange-700 bg-orange-50 px-3 py-1 rounded-full">
                        <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                        Only {{ $product->quantity }} left
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-green-700 bg-green-50 px-3 py-1 rounded-full">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        {{ $product->quantity }} in stock
                    </span>
                    @endif
                @else
                    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-red-700 bg-red-50 px-3 py-1 rounded-full">
                        <i class="ph-bold ph-x-circle"></i>
                        Out of Stock
                    </span>
                @endif
            </div>

            <!-- Cart Quantity Info -->
            @if($qtyInCart > 0)
            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                <div class="flex items-center gap-2 text-blue-800">
                    <i class="ph-fill ph-shopping-cart text-lg"></i>
                    <span class="text-sm font-medium">You already have <strong>{{ $qtyInCart }}</strong> {{ Str::plural('item', $qtyInCart) }} in your cart</span>
                </div>
                @if($availableQty > 0)
                <p class="text-xs text-blue-600 mt-1 ml-7">You can add {{ $availableQty }} more</p>
                @else
                <p class="text-xs text-blue-600 mt-1 ml-7">Maximum quantity reached</p>
                @endif
            </div>
            @endif

            <!-- Description -->
            <div class="prose prose-purple text-gray-600 mb-8 leading-relaxed">
                <p>{{$product->description}}</p>
            </div>

            <!-- Action Area -->
            <div class="mt-auto pt-8 border-t border-gray-100">
                <form action="{{route('cart.add', $product->id)}}" method="get">
                    @csrf
                    <input type="hidden" name="source_page" value="product_show">

                    @if($product->quantity > 0)
                    <div class="flex flex-col sm:flex-row gap-4">
                        <!-- Quantity Selector -->
                        <div class="flex items-center border border-gray-200 rounded-full bg-gray-50 w-max">
                            <button type="button" @click="decrement()" :disabled="qty <= 1" class="px-4 py-3 text-gray-600 hover:text-primary disabled:opacity-50 disabled:cursor-not-allowed transition">
                                <i class="ph-bold ph-minus"></i>
                            </button>
                            <input type="number" name="quantity" x-model="qty" readonly class="w-12 text-center bg-transparent border-none p-0 text-gray-900 font-bold focus:ring-0">
                            <button type="button" @click="increment()" :disabled="qty >= max" class="px-4 py-3 text-gray-600 hover:text-primary disabled:opacity-50 disabled:cursor-not-allowed transition">
                                <i class="ph-bold ph-plus"></i>
                            </button>
                        </div>

                        <!-- Add to Cart Button -->
                        <button type="submit" class="flex-1 bg-primary text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-purple-700 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
                            <i class="ph-bold ph-shopping-bag text-xl"></i>
                            Add to Cart
                        </button>
                    </div>
                    @else
                    <button disabled class="w-full bg-gray-100 text-gray-400 font-bold py-4 px-8 rounded-full cursor-not-allowed flex items-center justify-center gap-2">
                        <i class="ph-bold ph-prohibit text-xl"></i>
                        Currently Unavailable
                    </button>
                    @endif
                </form>
            </div>

        </div>
    </div>

    <!-- Recommendations -->
    @if($recommendations && $recommendations->count() > 0)
    <section class="mt-24">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-gray-900">You May Also Like</h2>
            <a href="{{route('user.products')}}" class="text-primary font-medium hover:underline">View All</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($recommendations as $recommendedProduct)
            <div class="group bg-white rounded-2xl p-3 border border-gray-100 hover:border-purple-100 hover:shadow-lg transition-all duration-300 flex flex-col h-full">
                <div class="relative aspect-square rounded-xl overflow-hidden bg-gray-50 mb-3">
                    <img src="/storage/{{ $recommendedProduct->image }}" 
                         alt="{{ $recommendedProduct->name }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    
                    @if($recommendedProduct->quantity < 1)
                    <div class="absolute top-2 left-2 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded">
                        Sold Out
                    </div>
                    @endif
                </div>

                <div class="flex flex-col flex-grow">
                    <p class="text-xs text-gray-500 mb-1 uppercase tracking-wider">{{ $recommendedProduct->category->name }}</p>
                    <a href="{{ route('user.product.show', $recommendedProduct->id) }}">
                        <h3 class="font-bold text-gray-900 text-sm mb-2 hover:text-primary transition line-clamp-1">{{ $recommendedProduct->name }}</h3>
                    </a>
                    <div class="mt-auto pt-3">
                        <div class="mb-2">
                            <span class="text-lg font-bold text-primary">Rs {{ number_format($recommendedProduct->price, 0) }}</span>
                        </div>
                        @if($recommendedProduct->quantity > 0)
                        <a href="{{ route('cart.add', $recommendedProduct->id) }}" class="w-full bg-gray-900 text-white py-2 px-3 rounded-lg text-xs font-bold hover:bg-primary transition flex items-center justify-center gap-1.5 shadow-md hover:shadow-lg">
                            <i class="ph-bold ph-shopping-cart"></i>
                            Add to Cart
                        </a>
                        @else
                        <button disabled class="w-full bg-gray-200 text-gray-400 py-2 px-3 rounded-lg text-xs font-bold cursor-not-allowed">
                            Sold Out
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

</main>
@endsection