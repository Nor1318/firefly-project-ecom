<?php

namespace App\Services;

use App\Models\Coupon;

class CouponService
{
    public function validateCoupon($code, $subtotal)
    {
        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return [
                'valid' => false,
                'message' => 'Invalid coupon code'
            ];
        }

        // Check if coupon is active
        if (!$coupon->is_active) {
            return [
                'valid' => false,
                'message' => 'This coupon is currently inactive'
            ];
        }

        // Check usage limit
        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
            return [
                'valid' => false,
                'message' => 'This coupon has reached its usage limit'
            ];
        }

        // Check date validity
        $now = now();
        if ($coupon->valid_from && $now->lt($coupon->valid_from)) {
            return [
                'valid' => false,
                'message' => 'This coupon is not yet valid'
            ];
        }
        if ($coupon->valid_until && $now->gt($coupon->valid_until)) {
            return [
                'valid' => false,
                'message' => 'This coupon has expired'
            ];
        }

        $discount = $coupon->calculateDiscount($subtotal);

        if ($discount <= 0) {
            return [
                'valid' => false,
                'message' => 'Coupon cannot be applied to this order'
            ];
        }

        return [
            'valid' => true,
            'coupon' => $coupon,
            'discount' => $discount,
            'message' => 'Coupon applied successfully!'
        ];
    }
}