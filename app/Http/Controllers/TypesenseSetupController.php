<?php

namespace App\Http\Controllers;

use App\Services\TypesenseService;
use Illuminate\Http\Request;

class TypesenseSetupController extends Controller
{
    protected $typesense;

    public function __construct(TypesenseService $typesense)
    {
        $this->typesense = $typesense;
    }

    /**
     * Setup Typesense collection and index products
     */
    public function setup()
    {
        try {
            // Create collection
            $this->typesense->createCollection();
            
            // Index all products
            $result = $this->typesense->indexAllProducts();
            
            return response()->json([
                'success' => true,
                'message' => 'Typesense collection created and products indexed successfully',
                'result' => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Reindex all products
     */
    public function reindex()
    {
        try {
            $result = $this->typesense->indexAllProducts();
            
            return response()->json([
                'success' => true,
                'message' => 'Products reindexed successfully',
                'result' => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}