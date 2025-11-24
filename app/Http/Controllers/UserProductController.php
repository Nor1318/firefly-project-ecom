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
    public function index(Request $request)
    {
        $categories = Category::query()->get();
        $products = Product::paginate(12);
        if ($request->category) {
            $products = Product::where('category_id', $request->category)->paginate(12);
        }
        return view('products.index', compact('products', 'categories'));
    }



    public function show(Product $product)
    {

        return view('products.show', compact('product'));
    }
}
