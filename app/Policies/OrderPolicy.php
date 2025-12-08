<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     * Users can view their own orders, admins can view all orders
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view their orders list
    }

    /**
     * Determine whether the user can view the model.
     * Users can only view their own orders, admins can view all orders
     */
    public function view(User $user, Order $order): bool
    {
        // Admin can view all orders
        if ($user->role === 'admin') {
            return true;
        }
        
        // Users can only view their own orders
        return $user->id === $order->user_id;
    }

    /**
     * Determine whether the user can create models.
     * All authenticated users can create orders
     */
    public function create(User $user): bool
    {
        return true; // All users can create orders
    }

    /**
     * Determine whether the user can update the model.
     * Only admins can update orders
     */
    public function update(User $user, Order $order): bool
    {
        // Only admins can update orders (change status, etc.)
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     * Users can cancel their own pending orders, admins can delete any order
     */
    public function delete(User $user, Order $order): bool
    {
        // Admin can delete any order
        if ($user->role === 'admin') {
            return true;
        }
        
        // Users can only cancel their own pending orders
        return $user->id === $order->user_id && $order->status === 'pending';
    }

    /**
     * Determine whether the user can restore the model.
     * Only admins can restore orders
     */
    public function restore(User $user, Order $order): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     * Only admins can permanently delete orders
     */
    public function forceDelete(User $user, Order $order): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can download invoice for the order.
     * Users can download their own invoices, admins can download any invoice
     */
    public function downloadInvoice(User $user, Order $order): bool
    {
        // Admin can download any invoice
        if ($user->role === 'admin') {
            return true;
        }
        
        // Users can only download their own invoices
        return $user->id === $order->user_id;
    }

    /**
     * Determine whether the user can email invoice for the order.
     * Only admins can email invoices
     */
    public function emailInvoice(User $user, Order $order): bool
    {
        return $user->role === 'admin';
    }
}
