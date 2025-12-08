<?php

namespace App\Services;

use Typesense\Client;
use Illuminate\Support\Facades\Log;

class TypesenseService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'api_key'         => config('scout.typesense.client-settings.api_key'),
            'nodes'           => [
                [
                    'host'     => config('scout.typesense.client-settings.nodes.0.host'),
                    'port'     => config('scout.typesense.client-settings.nodes.0.port'),
                    'protocol' => config('scout.typesense.client-settings.nodes.0.protocol'),
                ],
            ],
            'connection_timeout_seconds' => 2,
        ]);
    }

    /**
     * Search products using Typesense
     */
    public function search($query, $filters = [])
    {
        $searchParameters = [
            'q'         => $query,
            'query_by'  => 'name,description',
            'per_page'  => $filters['per_page'] ?? 12,
            'page'      => $filters['page'] ?? 1,
        ];

        // Add category filter if provided
        if (!empty($filters['category_id'])) {
            $searchParameters['filter_by'] = "category_id:={$filters['category_id']}";
        }

        // Add price range filters
        if (!empty($filters['min_price']) || !empty($filters['max_price'])) {
            $priceFilter = [];
            if (!empty($filters['min_price'])) {
                $priceFilter[] = "price:>={$filters['min_price']}";
            }
            if (!empty($filters['max_price'])) {
                $priceFilter[] = "price:<={$filters['max_price']}";
            }
            
            if (isset($searchParameters['filter_by'])) {
                $searchParameters['filter_by'] .= ' && ' . implode(' && ', $priceFilter);
            } else {
                $searchParameters['filter_by'] = implode(' && ', $priceFilter);
            }
        }

        // Add sorting if provided
        if (!empty($filters['sort_by'])) {
            $searchParameters['sort_by'] = $filters['sort_by'];
        }

        try {
            $results = $this->client->collections['products']->documents->search($searchParameters);
            return $results;
        } catch (\Exception $e) {
            Log::error('Typesense search error: ' . $e->getMessage());
            return ['hits' => [], 'found' => 0];
        }
    }

    /**
     * Index a product document
     */
    public function indexProduct($product)
    {
        try {
            $document = [
                'id'           => (string) $product->id,
                'name'         => $product->name,
                'description'  => $product->description ?? '',
                'price'        => (float) $product->price,
                'stock'        => (int) $product->stock,
                'category_id'  => (int) $product->category_id,
                'image'        => $product->image ?? '',
                'created_at'   => $product->created_at->timestamp,
            ];

            $this->client->collections['products']->documents->upsert($document);
            return true;
        } catch (\Exception $e) {
            Log::error('Typesense index error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete a product document
     */
    public function deleteProduct($productId)
    {
        try {
            $this->client->collections['products']->documents[(string) $productId]->delete();
            return true;
        } catch (\Exception $e) {
            Log::error('Typesense delete error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Create products collection if it doesn't exist
     */
    public function createProductsCollection()
    {
        try {
            $schema = [
                'name'   => 'products',
                'fields' => [
                    ['name' => 'name', 'type' => 'string'],
                    ['name' => 'description', 'type' => 'string'],
                    ['name' => 'price', 'type' => 'float'],
                    ['name' => 'stock', 'type' => 'int32'],
                    ['name' => 'category_id', 'type' => 'int32'],
                    ['name' => 'image', 'type' => 'string', 'optional' => true],
                    ['name' => 'created_at', 'type' => 'int64'],
                ],
                'default_sorting_field' => 'created_at',
            ];

            $this->client->collections->create($schema);
            return true;
        } catch (\Exception $e) {
            if (strpos($e->getMessage(), 'already exists') !== false) {
                return true; // Collection already exists, that's fine
            }
            Log::error('Typesense collection creation error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Check if Typesense is available
     */
    public function isAvailable()
    {
        try {
            $this->client->health->retrieve();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
