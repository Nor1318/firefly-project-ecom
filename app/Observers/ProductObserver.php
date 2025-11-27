<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\TypesenseService;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    protected $typesense;

    public function __construct(TypesenseService $typesense)
    {
        $this->typesense = $typesense;
    }

    public function created(Product $product)
    {
        try {
            // Load category if not already loaded
            if (!$product->relationLoaded('category')) {
                $product->load('category');
            }
            $this->typesense->indexProduct($product);
        } catch (\Exception $e) {
            Log::error('Typesense indexing error on create: ' . $e->getMessage());
        }
    }

    public function updated(Product $product)
    {
        try {
            // Load category if not already loaded
            if (!$product->relationLoaded('category')) {
                $product->load('category');
            }
            $this->typesense->indexProduct($product);
        } catch (\Exception $e) {
            Log::error('Typesense indexing error on update: ' . $e->getMessage());
        }
    }

    public function deleted(Product $product)
    {
        try {
            $this->typesense->deleteProduct($product->id);
        } catch (\Exception $e) {
            Log::error('Typesense deletion error: ' . $e->getMessage());
        }
    }
}