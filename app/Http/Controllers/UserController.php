<?php

namespace App\Http\Controllers;

use App\User;
use App\Instansi;
use App\Imports\UserImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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

    public function import(Request $request)
    {
        $file = $request->file('file'); // Ambil file Excel dari formulir
        Excel::import(new UserImport, $file);
        return redirect()->back()->with('success', 'Data berhasil diimpor.');
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

    public function getUserDetails($id) {
        // Ambil informasi tambahan dari database berdasarkan ID user
        $user = User::find($id);
    
        // Misalnya, Anda dapat mengembalikan informasi dalam format HTML
        $details = '<p>Nama: <strong>' . $user->nama_user . '</strong></p>' .
                    '<p>Jenis Kelamin: <strong>' . $user->jenis_kelamin . '</strong></p>' .
                    '<p>Alamat: <strong>' . $user->alamat_user . '</strong></p>' .
                   '<p>Nomor Telepon: <strong>' . $user->nomor_telepon . '</strong></p>' .
                   '<p>Departement: <strong>' . $user->departement . '</strong></p>' ;
    
        return $details;
    }
    

    public function update(Request $request, $id)
    {
        $user = User::find($id);
    
        $userData = $request->all();
    
        $this->validate($request, [
            'password' => 'nullable|min:6' // Password bisa tidak diubah
        ]);
    
        if ($request->input('password')) {
            $userData['password'] = bcrypt($request->input('password'));
        } else {
            $userData['password'] = $user->password; // Jika password tidak diubah, maka password tetap menggunakan password lama
        }
    
        $user->fill($userData); // Mengisi data pada objek user dengan data baru
        $user->save(); // Menyimpan perubahan pada database
    
        return redirect('/users')->with('success', 'User has been updated successfully.');
    }
    


    public function store(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6'
        ]);
    
        $userData = $request->all();

        if ($request->input('password')) {
            $userData['password'] = bcrypt($request->input('password'));
        }

        User::create($userData);
        return redirect('/users')->with('success', 'User has been updated successfully.');
    }

    function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with('success', 'User has been deleted successfully.');
    }
}