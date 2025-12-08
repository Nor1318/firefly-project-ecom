<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderItems']);

        // Search functionality
        if ($request->filled('q')) {
            $searchTerm = $request->input('q');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('id', 'like', "%{$searchTerm}%")
                  ->orWhereHas('user', function ($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', "%{$searchTerm}%")
                                ->orWhere('email', 'like', "%{$searchTerm}%");
                  });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sort by
        if ($request->filled('sort_by')) {
            if ($request->sort_by == 'amount_asc') {
                $query->orderBy('total_amount', 'asc');
            } elseif ($request->sort_by == 'amount_desc') {
                $query->orderBy('total_amount', 'desc');
            } elseif ($request->sort_by == 'oldest') {
                $query->oldest();
            }
        } else {
            $query->latest();
        }

        $orders = $query->paginate(15)->appends($request->query());
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.orders.create');
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
    public function show(Order $order)
    {
        $orderItems = OrderItem::query()->where('order_id', $order->id)->get();
        return view('admin.orders.show', compact('order', 'orderItems'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->update();
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Download invoice as PDF
     */
    public function downloadInvoice(Order $order)
    {
        $order->load(['user', 'address', 'orderItems.product', 'payment']);
        
        $pdf = Pdf::loadView('invoices.invoice', compact('order'));
        
        return $pdf->download('Invoice-' . $order->id . '.pdf');
    }

    /**
     * Send invoice via email
     */
    public function emailInvoice(Order $order)
    {
        $order->load(['user', 'address', 'orderItems.product', 'payment']);
        
        // Generate PDF
        $pdf = Pdf::loadView('invoices.invoice', compact('order'));
        $pdfPath = storage_path('app/invoices/invoice-' . $order->id . '.pdf');
        
        // Create directory if it doesn't exist
        if (!file_exists(storage_path('app/invoices'))) {
            mkdir(storage_path('app/invoices'), 0755, true);
        }
        
        // Save PDF temporarily
        $pdf->save($pdfPath);
        
        // Send email
        Mail::to($order->user->email)->send(new InvoiceMail($order, $pdfPath));
        
        // Delete temporary PDF
        if (file_exists($pdfPath)) {
            unlink($pdfPath);
        }
        
        return redirect()->back()->with('success', 'Invoice sent to ' . $order->user->email);
    }
}
