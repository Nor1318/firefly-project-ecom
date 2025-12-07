@extends('components.layouts.app')

@section('content')

<section class="bg-secondary/30 border-b border-purple-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold text-gray-900">About Kina</h1>
        <p class="text-gray-600 mt-2">Discover the joy of childhood with us</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="prose prose-lg max-w-none">
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Story</h2>
                <p class="text-gray-600 leading-relaxed">
                    Welcome to Kina, your trusted destination for premium kids' products. We believe that every child deserves the best, and we're committed to bringing you a curated collection of high-quality items that combine safety, style, and functionality.
                </p>
            </div>

            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Mission</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    At Kina, we're on a mission to make parenting easier and more joyful. We carefully select each product in our store, ensuring it meets our high standards for quality, safety, and design.
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <i class="ph-fill ph-check-circle text-primary text-xl flex-shrink-0 mt-1"></i>
                        <span class="text-gray-600">Quality products from trusted brands</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ph-fill ph-check-circle text-primary text-xl flex-shrink-0 mt-1"></i>
                        <span class="text-gray-600">Safe and tested for your little ones</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ph-fill ph-check-circle text-primary text-xl flex-shrink-0 mt-1"></i>
                        <span class="text-gray-600">Exceptional customer service</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="ph-fill ph-check-circle text-primary text-xl flex-shrink-0 mt-1"></i>
                        <span class="text-gray-600">Fast and reliable delivery</span>
                    </li>
                </ul>
            </div>

            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose Us?</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-purple-50 rounded-2xl p-6">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mb-4">
                            <i class="ph-fill ph-shield-check text-white text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Safety First</h3>
                        <p class="text-gray-600 text-sm">All our products meet international safety standards and are thoroughly tested.</p>
                    </div>
                    <div class="bg-purple-50 rounded-2xl p-6">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mb-4">
                            <i class="ph-fill ph-heart text-white text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Curated Selection</h3>
                        <p class="text-gray-600 text-sm">We handpick every item to ensure it meets our quality and design standards.</p>
                    </div>
                    <div class="bg-purple-50 rounded-2xl p-6">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mb-4">
                            <i class="ph-fill ph-truck text-white text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Fast Delivery</h3>
                        <p class="text-gray-600 text-sm">Quick and reliable shipping to get your products to you as soon as possible.</p>
                    </div>
                    <div class="bg-purple-50 rounded-2xl p-6">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mb-4">
                            <i class="ph-fill ph-headset text-white text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Customer Support</h3>
                        <p class="text-gray-600 text-sm">Our friendly team is always here to help with any questions or concerns.</p>
                    </div>
                </div>
            </div>

            <div class="bg-secondary/20 rounded-2xl p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Join the Kina Family</h2>
                <p class="text-gray-600 mb-6">Start shopping today and discover why thousands of parents trust Kina for their children's needs.</p>
                <a href="{{route('user.products')}}" class="inline-flex items-center gap-2 px-8 py-3 bg-primary text-white font-bold rounded-full hover:bg-purple-700 transition shadow-md">
                    Browse Products <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>
        </div>

    </div>
</section>

@endsection
