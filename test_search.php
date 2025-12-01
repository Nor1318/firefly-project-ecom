<?php

use App\Models\Product;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $results = Product::search('*')->get();
    echo "Found " . $results->count() . " products.\n";
    if ($results->count() > 0) {
        echo "First product: " . $results->first()->name . "\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
