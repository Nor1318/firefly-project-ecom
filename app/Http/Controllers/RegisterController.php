<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
  public function __invoke(){
            
       return view('register'); 
    }
    public function register(Request $request){
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
        return redirect()->route('login');
        

    }
    
};

     

