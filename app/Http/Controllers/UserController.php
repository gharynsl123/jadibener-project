<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $user = User::all();
        return view('user.index_user', compact('user'));
    }

    public function create()
    {
        return view('user.create_user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // Add validation rules for other fields if needed
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'role' => $request->role,
            // Add other fields here if needed
        ]);

        return redirect('/users')->with('success', 'User has been created successfully.');
    }

    function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with('success', 'User has been deleted successfully.');
    }
}