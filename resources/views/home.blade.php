@extends('components/layouts.app')

@section('content')



<section class="relative bg-white py-12 lg:py-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Left Side: Text -->
            <div class="order-2 lg:order-1 text-center lg:text-left">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block">Winter Collection</span>
                    <span class="block text-primary">New Arrivals</span>
                </h1>
                <p class="mt-4 text-lg text-gray-500 max-w-lg mx-auto lg:mx-0">
                    Discover the latest trends in fashion with our premium collection. Minimalist designs tailored for your comfort and style.
                </p>
                <div class="mt-8 flex justify-center lg:justify-start gap-4">
                    <a href="{{route('user.products')}}" class="flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-green-800 md:py-4 md:text-lg transition shadow-md">
                        Shop Now
                    </a>

                </div>
            </div>


            <div class="order-1 lg:order-2 relative">
                <div class="absolute -top-4 -right-4 w-full h-full bg-green-800 rounded-3xl transform translate-x-2 translate-y-2 -z-10"></div>

                <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                    alt="Woman shopping"
                    class="w-full h-[400px] lg:h-[500px] object-cover rounded-3xl shadow-xl">
            </div>

        </div>
    </div>
</section>



<section id="categories" class="py-16 bg-white py-10 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Shop by Category</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
            <a href="{{route('user.products')}}?category={{$category->id}}" class="group relative h-64 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Women's Fashion">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-6">
                    <h3 class="text-white text-xl font-bold">{{$category->name}}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>


<section id="shop" class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Latest Products</h2>
            <p class="mt-4 text-gray-500">Handpicked items just for you.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 group overflow-hidden">
                <div class="relative h-64 overflow-hidden bg-gray-200">
                    <img src="/storage/{{$product->image}}"
                        alt="Product"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">

                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-500 mb-1">{{$product->category->name}}</p>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{$product->name}}</h3>
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-xl font-bold text-primary">Rs {{$product->price}}</span>
                        <button class="bg-gray-100 hover:bg-primary hover:text-white text-gray-900 p-2 rounded-full transition-colors">
                            <a href="{{route('cart.add',$product->id)}}"><i class="ph-bold ph-plus"></i></a>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach



        </div>

        <div class="mt-12 text-center">
            <a href="{{route('user.products')}}" class="inline-block border-2 border-gray-900 text-gray-900 font-bold py-3 px-8 rounded-full hover:bg-gray-900 hover:text-white transition duration-300">
                View All Products
            </a>
        </div>
    </div>
</section>

@endsection