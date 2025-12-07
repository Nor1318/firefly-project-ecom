@extends('components.layouts.app')

@section('content')

<section class="bg-secondary/30 border-b border-purple-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-bold text-gray-900">Contact Us</h1>
        <p class="text-gray-600 mt-2">We'd love to hear from you</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Contact Information -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Get in Touch</h2>
                <p class="text-gray-600 mb-8">Have a question or need assistance? Our customer support team is here to help!</p>
                
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-purple-50 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="ph-fill ph-envelope text-primary text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Email</h3>
                            <p class="text-gray-600">support@kina.com</p>
                            <p class="text-sm text-gray-500 mt-1">We'll respond within 24 hours</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-purple-50 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="ph-fill ph-phone text-primary text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Phone</h3>
                            <p class="text-gray-600">+977 9812345678</p>
                            <p class="text-sm text-gray-500 mt-1">Mon-Fri, 9AM-6PM</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-purple-50 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="ph-fill ph-map-pin text-primary text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">Address</h3>
                            <p class="text-gray-600">Lakeside, Pokhara<br>Kaski, Nepal</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="font-bold text-gray-900 mb-4">Follow Us</h3>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-full bg-secondary flex items-center justify-center text-primary hover:bg-primary hover:text-white transition">
                            <i class="ph-fill ph-facebook-logo"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-secondary flex items-center justify-center text-primary hover:bg-primary hover:text-white transition">
                            <i class="ph-fill ph-instagram-logo"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-secondary flex items-center justify-center text-primary hover:bg-primary hover:text-white transition">
                            <i class="ph-fill ph-twitter-logo"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-gray-50 rounded-2xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Send us a Message</h2>
                
                <form class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
                        <input type="text" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" placeholder="John Doe" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" placeholder="john@example.com" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                        <input type="text" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition" placeholder="How can we help?" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea rows="5" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition resize-none" placeholder="Tell us more..." required></textarea>
                    </div>

                    <button type="submit" class="w-full px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-purple-700 transition shadow-md flex items-center justify-center gap-2">
                        Send Message <i class="ph-bold ph-paper-plane-tilt"></i>
                    </button>
                </form>
            </div>

        </div>

    </div>
</section>

@endsection
