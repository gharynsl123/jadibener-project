<?php

namespace App\Http\Controllers;

use App\User;
use App\Instansi;
use App\Imports\UserImport;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // authorization
    public function __construct() { $this->middleware('auth'); }

    // index page
    public function index() {
        $user = User::all();
        return view('user.index_user', compact('user'));
    }

    // create page
    public function create() {
        $instansi = Instansi::all();
        return view('user.create_user', compact('instansi'));
    }

    // Edit page
    public function edit($id) {
        $user = User::find($id);
        $instansi = Instansi::all();
        return view('user.edit_user', compact('user', 'instansi'));
    }

    // function store action
    public function store(Request $request){
        try {
            $this->validate($request, [
                'password' => 'required|min:6'
            ]);
    
            $userData = $request->all();
    
            if ($request->input('password')) {
                $userData['password'] = bcrypt($request->input('password'));
            }
    
            User::create($userData);
            
            return redirect('/users')->with('success', 'User has been created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->with('error', 'Duplicate entry. This user already exists.')->withInput();
            } else {
                return redirect()->back()->with('error', 'Error saving user data.')->withInput();
            }
        }
    }

    // functionn update action
    public function update(Request $request, $id) {
        try{
            $user = User::find($id);
        
            $userData = $request->all();
        
            $this->validate($request, [
                'password' => 'nullable|min:6'
            ]);
        
            if ($request->input('password')) {
                $userData['password'] = bcrypt($request->input('password'));
            } else {
                $userData['password'] = $user->password;
            }
        
            $user->fill($userData);
            $user->save();
        
            return redirect('/users')->with('success', 'User has been updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error saving user data.')->withInput();
        }
    }

    // function detele action
    function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with('success', 'User has been deleted successfully.');
    }


    // get detail user
    public function getUserDetails($id) {
        $user = User::find($id);
    
        $details = '<p>Nama: <strong>' . $user->nama_user . '</strong></p>' .
                    '<p>Jenis Kelamin: <strong>' . $user->jenis_kelamin . '</strong></p>' .
                    '<p>Alamat: <strong>' . $user->alamat_user . '</strong></p>' .
                   '<p>Nomor Telepon: <strong>' . $user->nomor_telepon . '</strong></p>' .
                   '<p>Departement: <strong>' . $user->departement . '</strong></p>' ;
    
        return $details;
    }

    // function uploud import
    public function import(Request $request) {
        $file = $request->file('file'); 
        Excel::import(new UserImport, $file);
        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }
}