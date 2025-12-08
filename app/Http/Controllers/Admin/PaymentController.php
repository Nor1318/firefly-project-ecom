<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Payment::with('order.user');

        // Search functionality
        if ($request->filled('q')) {
            $searchTerm = $request->input('q');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('id', 'like', "%{$searchTerm}%")
                  ->orWhere('payment_method', 'like', "%{$searchTerm}%")
                  ->orWhereHas('order.user', function ($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // Filter by payment method
        if ($request->filled('method')) {
            $query->where('payment_method', $request->method);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sort by
        if ($request->filled('sort_by')) {
            if ($request->sort_by == 'amount_asc') {
                $query->orderBy('amount', 'asc');
            } elseif ($request->sort_by == 'amount_desc') {
                $query->orderBy('amount', 'desc');
            } elseif ($request->sort_by == 'oldest') {
                $query->oldest();
            }
        } else {
            $query->latest();
        }

        $payments = $query->paginate(15)->appends($request->query());
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {

        $payment->status = $request->status;
        $payment->update();
        return redirect()->route('payments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function randomGen(Payment $payment)
    {
        $payment->update([
            'transaction_code' => random_int(10000000, 99999999)
        ]);

        return redirect()->route('payments.index');
    }
}
