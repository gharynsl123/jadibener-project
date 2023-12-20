<?php

namespace App\Http\Controllers;

use App\User;
use App\Instansi;
use App\Peralatan;
use App\Imports\InstansiImport;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    // authorization
    public function __construct() { $this->middleware('auth'); }

    // index page
    public function index() {
        $user = User::all();
        $instansi = Instansi::all();

        return view('instansi.index_instansi', compact('instansi', 'user'));
    }

    // index member onnly
    public function group() {
        $users = User::all();
        $idpic = User::whereNotNull('id_instansi')->get();

        // Ambil semua data instansi yang terkait dengan user yang memiliki id_instansi tidak null
        $instansi = Instansi::whereIn('id', $idpic->pluck('id_instansi')->all())->get();

        return view('instansi.index_instansi', compact('instansi', 'users', 'idpic'));
    }
    
    // create page
    public function create() {
        $user = User::where('level', 'pic_rs')->get();
        return view('instansi.create_instansi', compact('user'));
    }

    // detail page
    public function show($id) {
        $instansi = Instansi::find($id);
        $departements = ['Hospital Kitchen', 'CSSD', 'Purcashing', 'IPS-RS'];

        $user = User::where('id_instansi', $instansi->id)
            ->whereIn('departement', $departements)
            ->get();

        // Mengambil data peralatan yang terkait dengan pengguna yang sesuai
        $alat = Peralatan::whereIn('departement', $departements)
            ->where('id_instansi', $instansi->id)
            ->whereIn('departement', $departements)
            ->get();

            
        $jumlahPeralatanPerDepartemen = [];
        
        foreach ($user as $users) {
            $departemen = $users->departement;
        
            // Count the equipment for the specific institution and department
            $jumlahPeralatanPerDepartemen[$departemen] = $alat
                ->where('id_instansi', $instansi->id)
                ->where('departement', $departemen)
                ->count();
        }
    
        return view('instansi.detail_instansi', compact('user', 'alat', 'instansi', 'jumlahPeralatanPerDepartemen'));
    }
    
    // edit page
    public function edit($id) {
        $instansi = Instansi::find($id);

        $user = User::where('level', 'pic')->get();
        return view('instansi.edit_instansi', compact('instansi', 'user'));
    }

    // function store action
    public function store(Request $request) {
        try {
            $dataInstansi = $request->all();
    
            if($request->hasFile('photo_instansi')){
                $destination_path = 'public/rumahsakit';
                $image = $request -> file('photo_instansi');
                $image_name = $image->getClientOriginalName(); 
                $path = $request->file('photo_instansi')->storeAs($destination_path, $image_name);
                $dataInstansi['photo_instansi'] = $image_name;
            }
    
            Instansi::create($dataInstansi);
    
            return redirect('/instansi')->with('success', 'Data rumah sakit berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error saving user data.')->withInput();
        }
    }

    // function update action
    public function update(Request $request, $id) {
        try {
            $instansi = Instansi::find($id);
            $dataInstansi = $request->all();
    
            if($request->hasFile('photo_instansi')){
                $destination_path = 'public/rumahsakit'; 
                $image = $request -> file('photo_instansi'); 
                $image_name = $image->getClientOriginalName(); 
                $path = $request->file('photo_instansi')->storeAs($destination_path, $image_name);
                $dataInstansi['photo_instansi'] = $image_name; 
            } else{
                $dataInstansi['photo_instansi'] = $instansi->photo_instansi;
            }
            $instansi->update($dataInstansi);
    
            return redirect('/instansi')->with('success', 'Data rumah sakit berhasil diubah.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error saving user data.')->withInput();
        }
    }

    // function delete action
    public function destroy($id) {
        $instansi = Instansi::find($id);
        $instansi->delete();
        return redirect('/instansi');
    }

    // function import data
    public function import(Request $request) {
        $file = $request->file('file'); 
        Excel::import(new InstansiImport, $file);

        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }
    
}