<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::withCount('products');

        // Search functionality
        if ($request->filled('q')) {
            $searchTerm = $request->input('q');
            $query->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('slug', 'like', "%{$searchTerm}%");
        }

        // Sort by product count
        if ($request->filled('sort_by')) {
            if ($request->sort_by == 'products_asc') {
                $query->orderBy('products_count', 'asc');
            } elseif ($request->sort_by == 'products_desc') {
                $query->orderBy('products_count', 'desc');
            }
        } else {
            $query->latest();
        }

        $categories = $query->paginate(15)->appends($request->query());
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $categories)
    {
        $request->validate(
            [
                'name' => 'required|string|min:2|max:50|unique:categories',
                'slug' => 'required|min:2|max:255|unique:categories',
            ]
        );
        $categories->name = $request->name;
        $categories->slug = str::slug($request->slug);
        $categories->save();
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate(
            [
                'name' => 'required|string|min:2|max:50|unique:categories,name,' . $category->id,
                'slug' => 'required|min:2|max:255|unique:categories,slug,' . $category->id,
            ]


        );
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->update();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
