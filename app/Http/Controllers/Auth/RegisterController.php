<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function __invoke()
    {

        return view('register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255|',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed|',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        Mail::to($user->email)->send(new WelcomeMail($user));
        return redirect()->route('login');
    }
};
