<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\TypesenseService;
use Illuminate\Http\Request;

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

        // If there's a search query, use Typesense
        if ($query) {
            $filters = [
                'page' => $request->input('page', 1),
                'per_page' => 12,
                'category_id' => $request->input('category'),
                'min_price' => $request->input('min_price'),
                'max_price' => $request->input('max_price'),
                'sort_by' => $this->getSortBy($request->input('sort_by')),
            ];

            $results = $this->typesense->search($query, $filters);

            // Transform Typesense results to Product models
            $productIds = collect($results['hits'] ?? [])->pluck('document.id')->toArray();
            
            if (!empty($productIds)) {
                $products = Product::with('category')
                    ->whereIn('id', $productIds)
                    ->get()
                    ->sortBy(function ($product) use ($productIds) {
                        return array_search($product->id, $productIds);
                    })
                    ->values();
                
                // Manual pagination
                $currentPage = $filters['page'];
                $perPage = $filters['per_page'];
                $total = $results['found'] ?? 0;
                
                $products = new \Illuminate\Pagination\LengthAwarePaginator(
                    $products,
                    $total,
                    $perPage,
                    $currentPage,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            } else {
                $products = new \Illuminate\Pagination\LengthAwarePaginator(
                    collect([]),
                    0,
                    12,
                    1,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            }
        } else {
            // Regular query without search - FIXED HERE
            $products = Product::with('category');

            if ($request->category) {
                $products = $products->where('category_id', $request->category);
            }

            if ($request->min_price) {
                $products = $products->where('price', '>=', $request->min_price);
            }

            if ($request->max_price) {
                $products = $products->where('price', '<=', $request->max_price);
            }

            $sortBy = $request->sort_by;
            if ($sortBy) {
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
                        $products = $products->latest();
                        break;
                    default:
                        $products = $products->latest();
                }
            } else {
                $products = $products->latest();
            }

            $products = $products->paginate(12)->appends($request->query());
        }

        return view('products.index', compact('products', 'categories', 'query'));
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