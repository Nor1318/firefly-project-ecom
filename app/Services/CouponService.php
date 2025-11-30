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

        if (!$coupon->isValid()) {
            return [
                'valid' => false,
                'message' => 'This coupon is no longer valid'
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