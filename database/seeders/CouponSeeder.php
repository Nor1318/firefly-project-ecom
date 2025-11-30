<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    public function run()
    {
        Coupon::create([
            'code' => 'WELCOME10',
            'type' => 'percentage',
            'value' => 10,
            'min_order_amount' => 50,
            'usage_limit' => 100,
            'valid_until' => now()->addMonth(),
        ]);

        Coupon::create([
            'code' => 'SAVE5',
            'type' => 'fixed',
            'value' => 5,
            'min_order_amount' => 25,
            'usage_limit' => 50,
            'valid_until' => now()->addWeeks(2),
        ]);
    }
}