@extends('components/layouts.app')

@section('content')

<!-- Hero Section -->
<section class="relative bg-secondary overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center min-h-[600px] py-12 lg:py-0">
            
            <!-- Text Content -->
            <div class="order-2 lg:order-1 text-center lg:text-left z-10">
                <span class="inline-block py-1 px-3 rounded-full bg-white text-primary text-sm font-semibold mb-6 shadow-sm">
                    New Collection 2025
                </span>
                <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight mb-6">
                    A Young Touch <br>
                    <span class="text-primary">In Your Home</span>
                </h1>
                <p class="text-lg text-gray-600 mb-8 max-w-lg mx-auto lg:mx-0 leading-relaxed">
                    Discover our premium collection of baby gear, toys, and fashion. Designed with love for your little ones' comfort and joy.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{route('user.products')}}" class="px-8 py-4 bg-primary text-white font-semibold rounded-full hover:bg-purple-700 transition shadow-lg hover:shadow-xl hover:-translate-y-1 transform duration-200">
                        Shop Now
                    </a>
                </div>
            </div>

            <!-- Hero Image -->
            <div class="order-1 lg:order-2 relative">
                <!-- Decorative blobs -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-purple-200 rounded-full blur-3xl opacity-50 -z-10"></div>
                <div class="absolute top-0 right-0 w-32 h-32 bg-accent/20 rounded-full blur-2xl -z-10"></div>
                
                <img src="https://images.unsplash.com/photo-1519689680058-324335c77eba?q=80&w=1000&auto=format&fit=crop" 
                     alt="Baby Stroller" 
                     class="w-full max-w-lg mx-auto transform hover:scale-105 transition duration-500 drop-shadow-2xl">
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section id="categories" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Shop by Category</h2>
                <p class="text-gray-500 mt-2">Explore our wide range of collections</p>
            </div>
            <div class="flex gap-2" x-data="{ 
                scrollContainer: null,
                init() {
                    this.scrollContainer = this.$refs.categoryScroll;
                },
                scrollLeft() {
                    this.scrollContainer.scrollBy({ left: -300, behavior: 'smooth' });
                },
                scrollRight() {
                    this.scrollContainer.scrollBy({ left: 300, behavior: 'smooth' });
                }
            }">
                <button @click="scrollLeft()" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-primary hover:text-white transition">
                    <i class="ph-bold ph-caret-left"></i>
                </button>
                <button @click="scrollRight()" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-primary hover:text-white transition">
                    <i class="ph-bold ph-caret-right"></i>
                </button>
            </div>
        </div>

        <div x-ref="categoryScroll" class="overflow-x-auto scrollbar-hide scroll-smooth">
            <div class="flex gap-8 pb-4" style="min-width: min-content;">
                @foreach($categories as $category)
                <a href="{{route('user.products')}}?category={{$category->id}}" class="group flex flex-col items-center text-center flex-shrink-0">
                    <div class="w-32 h-32 rounded-full overflow-hidden mb-4 border-4 border-transparent group-hover:border-primary/20 transition-all duration-300 shadow-sm group-hover:shadow-md bg-secondary flex items-center justify-center">
                        <span class="text-4xl font-bold text-primary">{{substr($category->name, 0, 1)}}</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 group-hover:text-primary transition whitespace-nowrap">{{$category->name}}</h3>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Latest Products -->
<section id="shop" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-primary font-semibold tracking-wider uppercase text-sm">New Arrivals</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Latest Products</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
            <div class="bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl transition-all duration-300 group flex flex-col h-full">
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
                    <a href="{{route('user.product.show', $product->id)}}">
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
                        <button disabled class="w-full bg-gray-200 text-gray-400 py-2.5 px-4 rounded-lg text-sm font-bold cursor-not-allowed">
                            Sold Out
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-16 text-center">
            <a href="{{route('user.products')}}" class="inline-flex items-center gap-2 px-8 py-3 border-2 border-gray-900 rounded-full font-semibold hover:bg-gray-900 hover:text-white transition duration-300">
                View All Products
                <i class="ph-bold ph-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

@endsection