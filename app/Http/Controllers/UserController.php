<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Instansi;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // auth 
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $user = User::all();
        return view('user.index_user', compact('user'));
    }

    public function create()
    {
        $instansi = Instansi::all();
        return view('user.create_user', compact('instansi'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $instansi = Instansi::all();
        return view('user.edit_user', compact('user', 'instansi'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $instansi = Instansi::all();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            // Add validation rules for other fields if needed
        ]);

         // Cek apakah password kosong
         if ($request->password == null) {
            // Jika kosong, maka password tetap
            $user->password = $user->password;
        } else {
            $user->password = bcrypt($request->password);
        }

        $user->name = $request->name;
        $user->no_telp = $request->no_telp;
        $user->jenis_kelamin = $request->jenins_kelammin;
        $user->id_instansi = $request->id_instansi;
        $user->alamat = $request->alamat;
        $user->level = $request->level;
        $user->role = $request->role;
        $user->save();

        return redirect('/users')->with('success', 'User has been updated successfully.');
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
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_instansi' => $request->id_instansi,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'role' => $request->role
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