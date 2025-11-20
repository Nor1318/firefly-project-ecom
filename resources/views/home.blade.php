@extends('components/layouts.app')

@section('content')


<section class="max-w-7xl mx-auto px-6 py-20 text-center">
    <h1 class="text-5xl font-bold text-gray-900 mb-6">Welcome to Our Store</h1>
    <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">Discover amazing products at great prices. Shop now and enjoy a seamless shopping experience.</p>
    <a href="{{route('user.products')}}" class="inline-block px-8 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 text-lg">Shop Now</a>
</section>


@session('success')
<div id="temp-message" class=" w-full bg-red-800 rounded-lg  text-white h-6 flex justify-center text-align-center alert alert-success m-5">{{$value}}</div>
@endsession
<section class="max-w-7xl mx-auto px-6 py-16">
    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Latest Products</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @foreach($products as $product)

        <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
            <a href="{{ route('user.product.show', $product->id) }}">
                <div class="h-48 bg-gray-200 rounded-t-lg flex items-center justify-center">
                    <img src="/storage/{{$product->image}}" alt="{{$product->name}}">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-2">{{$product->name}}</h3>
                    <p class="text-gray-600 text-sm mb-3">{{$product->description}}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-gray-900">Rs {{$product->price}}</span>
                        <form action="{{route('cart.add',$product->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm rounded hover:bg-gray-800">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</section>



<footer class="bg-white border-t mt-20">
    <div class="max-w-7xl mx-auto px-6 py-8 text-center text-gray-600">
        <p>&copy; 2025 MyStore. All rights reserved.</p>
    </div>
</footer>

<script>
    setTimeout(() => document.getElementById('temp-message').classList.add('hidden'), 2000);
</script>

@endsection