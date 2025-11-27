<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Http\Controllers\UserProductController;

class TestHttpRequest extends Command
{
    protected $signature = 'test:http {q?}';
    protected $description = 'Test HTTP request to products endpoint';

    public function handle()
    {
        $query = $this->argument('q') ?? 'Chocolates';
        
        // Create a mock request
        $request = new Request();
        $request->merge([
            'q' => $query,
            'category' => '',
            'min_price' => '',
            'max_price' => '',
            'sort_by' => '',
        ]);

        // Test the controller method
        $controller = app(UserProductController::class);
        
        $this->info("Testing request with: q={$query}");
        
        try {
            // Call the index method directly
            $view = $controller->index($request);
            
            // Get the data passed to the view
            $viewData = $view->getData();
            $products = $viewData['products'];
            
            $this->line("\nResults:");
            $this->line("Total products: " . count($products->items()));
            
            foreach ($products->items() as $product) {
                $this->line("  - {$product->name} (ID: {$product->id}, Price: {$product->price})");
            }
            
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            $this->error($e->getTraceAsString());
        }
    }
}
