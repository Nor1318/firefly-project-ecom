@extends('../components/layouts.app')

@section('content')

<main class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-4">
            @php
            $total = 0;
            $shipping = 100;
            @endphp

            @foreach(Auth::user()->cart->cartItems as $cartItem)
            @php
            $total += $cartItem->product->price * $cartItem->quantity
            @endphp
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center gap-6">
                    <div class="w-24 h-24 bg-gray-200 rounded flex items-center justify-center flex-shrink-0">
                        <img src="/storage/{{$cartItem->product->image}}" alt="">
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-semibold text-gray-900">{{$cartItem->product->name}}</h3>
                        <p class="text-gray-600 text-sm">{{$cartItem->product->description}}</p>
                        <p class="text-lg font-bold text-gray-900 mt-2">Rs {{$cartItem->product->price}}</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <form action="{{ route('cart.update', $cartItem->product->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <div class="flex items-center border border-gray-300 rounded">
                                <button type="submit" name="quantity" value="{{$cartItem->quantity - 1}}" class="px-3 py-1 text-gray-600 hover:bg-gray-100">-</button>
                                <span class="px-4 py-1 border-x border-gray-300">{{$cartItem->quantity}}</span>
                                <button type="submit" name="quantity" value="{{$cartItem->quantity + 1}}" class="px-3 py-1 text-gray-600 hover:bg-gray-100">+</button>
                            </div>
                            @error('quantity')
                            <div class="text-red-500">{{$message}}</div>
                            @enderror
                        </form>
                        <form method="post" action="{{route('cart.destroy', $cartItem->product->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-800">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6 sticky top-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Order Summary</h2>

                <div class="space-y-3 mb-4">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>Rs {{$total}}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Shipping</span>
                        <span>Rs {{$shipping}}</span>
                    </div>

                    <div class="border-t pt-3 flex justify-between text-lg font-bold text-gray-900">
                        <span>Total</span>
                        <span>Rs {{$total + $shipping}}</span>
                    </div>
                </div>
                @php
                $final = $total + $shipping
                @endphp

                <a href="{{route('checkout.index')}}" class="block w-full px-6 py-3 bg-gray-900 text-white text-center rounded-lg hover:bg-gray-800 mb-3">
                    Proceed to Checkout
                </a>
                <a href="{{route('products.index')}}" class="block w-full px-6 py-3 bg-gray-200 text-gray-900 text-center rounded-lg hover:bg-gray-300">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</main>


@endsection