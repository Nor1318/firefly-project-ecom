<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\TypesenseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserProductController extends Controller
{
    protected $typesense;

    public function __construct(TypesenseService $typesense)
    {
        $this->typesense = $typesense;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = $request->input('q', '');
        
        Log::debug('Product Search', [
            'query' => $query,
            'category' => $request->input('category'),
            'min_price' => $request->input('min_price'),
            'max_price' => $request->input('max_price'),
            'sort_by' => $request->input('sort_by'),
        ]);

        // Build base query with filters
        $products = Product::with('category');

        // Apply category filter
        if ($request->filled('category')) {
            $products = $products->where('category_id', $request->category);
        }

        // Apply price range filters
        if ($request->filled('min_price')) {
            $products = $products->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $products = $products->where('price', '<=', $request->max_price);
        }

        // Apply search query (database search as fallback or primary)
        if ($query) {
            $products = $products->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhereHas('category', function ($cat) use ($query) {
                      $cat->where('name', 'like', "%{$query}%");
                  });
            });
        }

        // Apply sorting logic
        $sortBy = $request->sort_by;
        switch ($sortBy) {
            case 'price_asc':
                $products = $products->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $products = $products->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $products = $products->orderBy('name', 'asc');
                break;
            case 'newest':
                $products = $products->latest('created_at');
                break;
            default:
                $products = $products->latest('created_at');
        }

        // Paginate results
        $products = $products->paginate(12)->appends($request->query());
        
        Log::debug('Products Found', [
            'count' => count($products->items()),
            'total' => $products->total(),
        ]);

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Convert sort option to Typesense format
     */
    private function getSortBy($sortBy)
    {
        switch ($sortBy) {
            case 'price_asc':
                return 'price:asc';
            case 'price_desc':
                return 'price:desc';
            case 'name_asc':
                return 'name:asc';
            case 'newest':
                return 'created_at:desc';
            default:
                return 'created_at:desc';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }
}