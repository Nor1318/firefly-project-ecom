<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $users)
    {

        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email|min:3',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,user'
        ]);

        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;
        $users->role = $request->role;
        $users->save();
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $addresses = Address::query()->where('user_id', $user->id)->get();
        return view('admin.users.show', compact('user', 'addresses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|email|min:3',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,user'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->update();
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
