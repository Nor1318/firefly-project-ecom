<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $products = Product::query()->latest()->take(4)->get();
        $categories = Category::has('products')->latest()->get();
        return view('home', compact('products', 'categories'));
    }
}
