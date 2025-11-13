<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'payment_method' => fake()->randomElement(['esewa', 'khalti', 'stripe', 'paypal']),
            'transaction_code' => fake()->unique()->randomNumber(8),
            'status' => fake()->randomElement(['unpaid', 'pending', 'paid', 'failed']),
        ];
    }
}
