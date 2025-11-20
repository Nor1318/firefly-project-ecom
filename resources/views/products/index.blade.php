@extends('../components/layouts.app')

@section('content')

<main class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex items-center justify-between mb-8">
        <div class="mb-5 pb-4">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">All Products</h1>
            <p class="text-gray-600 mt-1 mb-2">Showing {{count($products)}} products</p>
            @session('success')
            <div id="temp-message" class=" w-full bg-red-800 rounded-lg  text-white h-6 flex justify-center text-align-center alert alert-success m-5">{{$value}}</div>
            @endsession
        </div>

    </div>

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

                    <div class="mb-4">
                        <span class="text-2xl font-bold text-gray-900">Rs {{$product->price}}</span>
                    </div>
                </div>
            </a>

            <div class="p-4 pt-0">
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
        @endforeach

    </div>
    {{$products->links()}}

</main>
<script>
    setTimeout(() => document.getElementById('temp-message').classList.add('hidden'), 2000);
</script>


@endsection