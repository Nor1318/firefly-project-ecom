<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class TestSearchDebug extends Command
{
    protected $signature = 'test:search {query?}';
    protected $description = 'Test search functionality';

    public function handle()
    {
        $query = $this->argument('query') ?? 'Chocolates';
        
        $this->info("Testing search for: '{$query}'");
        
        // Test 1: Simple LIKE search on name
        $this->line("\n--- Test 1: Search by name only ---");
        $products = Product::where('name', 'like', "%{$query}%")->get();
        $this->line("Found: " . count($products) . " products");
        foreach ($products as $product) {
            $this->line("  - {$product->name} (ID: {$product->id})");
        }

        // Test 2: Search with category relationship
        $this->line("\n--- Test 2: Search by name or category ---");
        $products = Product::with('category')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhereHas('category', function ($cat) use ($query) {
                      $cat->where('name', 'like', "%{$query}%");
                  });
            })
            ->get();
        $this->line("Found: " . count($products) . " products");
        foreach ($products as $product) {
            $this->line("  - {$product->name} (ID: {$product->id}, Category: {$product->category->name})");
        }

        // Test 3: All products
        $this->line("\n--- Test 3: All products in database ---");
        $all = Product::with('category')->get();
        $this->line("Total products: " . count($all));
        foreach ($all as $product) {
            $this->line("  - {$product->name} (ID: {$product->id}, Price: {$product->price})");
        }
    }
}
