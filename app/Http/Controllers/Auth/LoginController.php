<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke()
    {
        return view('login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]
        );


        if (Auth::attempt($credentials)) {
            // Merge session cart into user's cart
            CartController::mergeSessionCart(Auth::user());
            
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin');
            } elseif (Auth::user()->role == 'user') {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login.show');
        }
    }
}
