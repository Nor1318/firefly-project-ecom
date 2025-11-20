<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->get();

        $products = Product::paginate(10);

        return view('products.index', compact('products', 'categories'));
    }



    public function show(Product $product)
    {

        return view('products.show', compact('product'));
    }
}
