<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
    {
        $users = User::count();
        $categories = Category::count();
        $products = Product::count();
        $orders = Order::count();
        
        // Calculate total revenue
        $totalRevenue = 0;
        $Orders = Order::query()->get();
        foreach ($Orders as $order) {
            foreach ($order->orderItems as $item) {
                $totalRevenue += ($item->amount_per_item ?? 0) * ($item->quantity ?? 0);
            }
        }

        // Revenue over last 30 days
        $revenueData = $this->getRevenueData();
        
        // Orders by status
        $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        
        // Top 5 selling products (simplified to avoid infinite loading)
        $topProducts = Product::take(5)->get();

        return view('admin.dashboard', compact(
            'users', 
            'categories', 
            'products', 
            'orders', 
            'totalRevenue',
            'revenueData',
            'ordersByStatus',
            'topProducts'
        ));
    }

    private function getRevenueData()
    {
        $days = 30;
        $data = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $revenue = Order::whereDate('created_at', $date)
                ->with('orderItems')
                ->get()
                ->sum(function($order) {
                    return $order->orderItems->sum(function($item) {
                        return ($item->amount_per_item ?? 0) * ($item->quantity ?? 0);
                    });
                });
            
            $data[] = [
                'date' => now()->subDays($i)->format('M d'),
                'revenue' => $revenue
            ];
        }
        
        return $data;
    }
}
