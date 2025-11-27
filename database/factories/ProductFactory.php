<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'image' => "image/1.jpg",
            'price' => fake()->numberBetween(0, 50000),
            'quantity' => fake()->numberBetween(1, 1000),
            'description' => fake()->text(),
            'category_id' => Category::factory(),

        ];
    }
}
