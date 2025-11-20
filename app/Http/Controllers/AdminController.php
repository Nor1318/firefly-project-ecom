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
        $totalRevenue = 0;
        $Orders = Order::query()->get();

        foreach ($Orders as $order) {

            foreach ($order->orderItems as $item) {
                $totalRevenue += ($item->amount_per_item ?? 0) * ($item->quantity ?? 0);
            }
        }


        return view('admin.dashboard', compact('users', 'categories', 'products', 'orders', 'totalRevenue'));
    }
}
