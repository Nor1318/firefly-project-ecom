<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        
        // Check if there's an actual search query
        $hasSearch = $request->filled('q') && $request->input('q') !== '*';
        
        if ($hasSearch) {
            // Use Scout search when there's a query
            $search = Product::search($request->input('q'));
        } else {
            // Use regular query builder when no search
            $query = Product::query();
            
            // Apply category filter
            if ($request->filled('category')) {
                $query->where('category_id', (int) $request->category);
            }
            
            // Apply price range filters
            if ($request->filled('min_price')) {
                $query->where('price', '>=', $request->min_price * 100);
            }
            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->max_price * 100);
            }
            
            // Apply sorting
            $sortBy = $request->sort_by;
            switch ($sortBy) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'newest':
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
            
            // Paginate results
            $products = $query->paginate(12)->appends($request->query());
            
            return view('products.index', compact('products', 'categories'));
        }
        
        // Scout search path (when there's a search query)

        // Apply category filter
        if ($request->filled('category')) {
            $search->where('category_id', (int) $request->category);
        }

        // Apply price range filters (using where for exact matches or custom query for ranges if supported by driver)
        // Note: Standard Scout 'where' is equality only. For ranges with Typesense, we use 'options' to pass raw filter_by.
        // However, let's try to keep it simple first. If using Typesense driver, we can pass filter_by in options.
        
        $filterBy = [];
        if ($request->filled('min_price')) {
            $filterBy[] = 'price:>=' . $request->min_price;
        }
        if ($request->filled('max_price')) {
            $filterBy[] = 'price:<=' . $request->max_price;
        }
        
        if (!empty($filterBy)) {
            $search->options([
                'filter_by' => implode(' && ', $filterBy)
            ]);
        }

        // Apply sorting
        // Scout's orderBy works if the driver supports it.
        $sortBy = $request->sort_by;
        switch ($sortBy) {
            case 'price_asc':
                $search->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $search->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $search->orderBy('name', 'asc');
                break;
            case 'newest':
            default:
                $search->orderBy('created_at', 'desc');
                break;
        }

        // Paginate results
        $products = $search->paginate(12)->appends($request->query());
        
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category');
        
        // Get recommended products
        $recommendations = $product->getRecommendations(6);
        
        // Calculate quantity already in cart
        $qtyInCart = 0;
        if (Auth::check()) {
            $cart = Auth::user()->cart;
            if ($cart) {
                $cartItem = $cart->cartItems()->where('product_id', $product->id)->first();
                $qtyInCart = $cartItem ? $cartItem->quantity : 0;
            }
        } else {
            // Guest user - check session cart
            $sessionCart = Session::get('cart', []);
            $qtyInCart = isset($sessionCart[$product->id]) ? $sessionCart[$product->id]['quantity'] : 0;
        }
        
        // Calculate available quantity (stock - already in cart)
        $availableQty = max(0, $product->quantity - $qtyInCart);
        
        return view('products.show', compact('product', 'recommendations', 'qtyInCart', 'availableQty'));
    }
}