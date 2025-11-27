<?php

namespace App\Services;

use Typesense\Client;
use App\Models\Product;

class TypesenseService
{
    protected $client;
    protected $collectionName = 'products';

    public function __construct()
    {
        $this->client = new Client([
            'api_key' => env('TYPESENSE_API_KEY', 'xyz'),
            'nodes' => [
                [
                    'host' => env('TYPESENSE_HOST', 'localhost'),
                    'port' => env('TYPESENSE_PORT', '8108'),
                    'protocol' => env('TYPESENSE_PROTOCOL', 'http'),
                ],
            ],
            'connection_timeout_seconds' => 2,
        ]);
    }

    /**
     * Create the products collection
     */
    public function createCollection()
    {
        try {
            // Delete if exists
            $this->client->collections[$this->collectionName]->delete();
        } catch (\Exception $e) {
            // Collection doesn't exist, continue
        }

        $schema = [
            'name' => $this->collectionName,
            'fields' => [
                ['name' => 'id', 'type' => 'string'],
                ['name' => 'name', 'type' => 'string'],
                ['name' => 'slug', 'type' => 'string'],
                ['name' => 'description', 'type' => 'string'],
                ['name' => 'price', 'type' => 'float', 'facet' => true],
                ['name' => 'quantity', 'type' => 'int32', 'facet' => true],
                ['name' => 'image', 'type' => 'string', 'optional' => true],
                ['name' => 'category_id', 'type' => 'int32', 'facet' => true],
                ['name' => 'category_name', 'type' => 'string', 'facet' => true],
                ['name' => 'created_at', 'type' => 'int64'],
            ],
            'default_sorting_field' => 'created_at',
        ];

        return $this->client->collections->create($schema);
    }

    /**
     * Index a single product
     */
    public function indexProduct(Product $product)
    {
        $document = [
            'id' => (string) $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'description' => $product->description ?? '',
            'price' => (float) $product->price,
            'quantity' => (int) $product->quantity,
            'image' => $product->image ?? '',
            'category_id' => (int) $product->category_id,
            'category_name' => $product->category->name ?? '',
            'created_at' => $product->created_at->timestamp,
        ];

        return $this->client->collections[$this->collectionName]
            ->documents
            ->upsert($document);
    }

    /**
     * Index multiple products
     */
    public function indexAllProducts()
    {
        $products = Product::with('category')->get();
        $documents = [];

        foreach ($products as $product) {
            $documents[] = [
                'id' => (string) $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'description' => $product->description ?? '',
                'price' => (float) $product->price,
                'quantity' => (int) $product->quantity,
                'image' => $product->image ?? '',
                'category_id' => (int) $product->category_id,
                'category_name' => $product->category->name ?? '',
                'created_at' => $product->created_at->timestamp,
            ];
        }

        return $this->client->collections[$this->collectionName]
            ->documents
            ->import($documents, ['action' => 'upsert']);
    }

    /**
     * Search products
     */
    public function search($query, $filters = [])
    {
        $searchParams = [
            'q' => $query ?: '*',
            'query_by' => 'name,description,category_name',
            'per_page' => $filters['per_page'] ?? 12,
            'page' => $filters['page'] ?? 1,
        ];

        // Build filter conditions
        $filterConditions = [];

        // Add category filter
        if (!empty($filters['category_id'])) {
            $filterConditions[] = "category_id:={$filters['category_id']}";
        }

        // Add price range filter
        if (isset($filters['min_price'])) {
            $filterConditions[] = "price:>={$filters['min_price']}";
        }
        if (isset($filters['max_price'])) {
            $filterConditions[] = "price:<={$filters['max_price']}";
        }

        // Add stock filter (in stock only)
        if (!empty($filters['in_stock'])) {
            $filterConditions[] = "quantity:>0";
        }

        if (!empty($filterConditions)) {
            $searchParams['filter_by'] = implode(' && ', $filterConditions);
        }

        // Add sorting
        if (!empty($filters['sort_by'])) {
            $searchParams['sort_by'] = $filters['sort_by'];
        }

        try {
            return $this->client->collections[$this->collectionName]
                ->documents
                ->search($searchParams);
        } catch (\Exception $e) {
            return [
                'found' => 0,
                'hits' => [],
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Delete a product from index
     */
    public function deleteProduct($productId)
    {
        try {
            return $this->client->collections[$this->collectionName]
                ->documents[(string) $productId]
                ->delete();
        } catch (\Exception $e) {
            // Product not found in index, ignore
            return null;
        }
    }

    /**
     * Get facets for filters
     */
    public function getFacets()
    {
        $searchParams = [
            'q' => '*',
            'query_by' => 'name',
            'facet_by' => 'category_name,price',
            'max_facet_values' => 100,
            'per_page' => 0,
        ];

        try {
            $results = $this->client->collections[$this->collectionName]
                ->documents
                ->search($searchParams);

            return $results['facet_counts'] ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }
}