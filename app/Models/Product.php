<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'price',
        'quantity',
        'description',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100,

        );
    }

    use \Laravel\Scout\Searchable;

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => (float) $this->price,
            'category_id' => (int) $this->category_id,
            'category_name' => $this->category->name ?? '',
            'created_at' => $this->created_at->timestamp,
        ];
    }

    /**
     * Get recommended products based on similarity scoring
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getRecommendations($limit = 6)
    {
        // Get all products except current one, only in-stock
        $recommendations = Product::where('id', '!=', $this->id)
            ->where('quantity', '>', 0)
            ->with(['category', 'orderItems'])
            ->get()
            ->map(function ($product) {
                $score = 0;
                
                // Same category: +100 points
                if ($product->category_id === $this->category_id) {
                    $score += 100;
                }
                
                // Similar price range (±30%): +50 points
                $priceMin = $this->price * 0.7;
                $priceMax = $this->price * 1.3;
                if ($product->price >= $priceMin && $product->price <= $priceMax) {
                    $score += 50;
                }
                
                // Popularity based on order count: +10 points per order
                $orderCount = $product->orderItems->count();
                $score += $orderCount * 10;
                
                // Add score to product for debugging/display
                $product->recommendation_score = $score;
                
                return $product;
            })
            ->sortByDesc('recommendation_score')
            ->take($limit);
        
        return $recommendations;
    }
}