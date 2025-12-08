<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Coupon::query();

        // Search functionality
        if ($request->filled('q')) {
            $searchTerm = $request->input('q');
            $query->where('code', 'like', "%{$searchTerm}%");
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status == 'active') {
                $query->whereDate('expires_at', '>=', now())
                      ->where('max_uses', '>', 0);
            } elseif ($request->status == 'expired') {
                $query->whereDate('expires_at', '<', now());
            } elseif ($request->status == 'used_up') {
                $query->where('max_uses', '<=', 0);
            }
        }

        // Sort by
        if ($request->filled('sort_by')) {
            if ($request->sort_by == 'discount_desc') {
                $query->orderBy('discount', 'desc');
            } elseif ($request->sort_by == 'discount_asc') {
                $query->orderBy('discount', 'asc');
            } elseif ($request->sort_by == 'expiring_soon') {
                $query->orderBy('expires_at', 'asc');
            }
        } else {
            $query->latest();
        }

        $coupons = $query->paginate(15)->appends($request->query());
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'is_active' => 'boolean',
        ]);

        $coupon = new Coupon();
        $coupon->code = strtoupper($request->code);
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->min_order_amount = $request->min_order_amount;
        $coupon->usage_limit = $request->usage_limit;
        $coupon->valid_from = $request->valid_from;
        $coupon->valid_until = $request->valid_until;
        $coupon->is_active = $request->has('is_active') ? true : false;
        $coupon->save();

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return view('admin.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'is_active' => 'boolean',
        ]);

        $coupon->code = strtoupper($request->code);
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->min_order_amount = $request->min_order_amount;
        $coupon->usage_limit = $request->usage_limit;
        $coupon->valid_from = $request->valid_from;
        $coupon->valid_until = $request->valid_until;
        $coupon->is_active = $request->has('is_active') ? true : false;
        $coupon->save();

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully');
    }
}
