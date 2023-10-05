<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departement;

class DepartemenController extends Controller
{
    public function index() {
        $departement = Departement::all();
        return view('depart.index_departement');
    }
   
    public function getDepartement() {
        $depart = Departement::all();
        return response()->json($depart);
    }
    public function edit($id) {
        $departement = Departement::find($id);
        return response()->json($departement);
    }

    public function store(Request $request) {
        // Validasi data yang masuk, misalnya nama departemen wajib diisi
        $validatedData = $request->validate([
            'nama_departement' => 'required',
        ]);

        $departement = new Departement();
        $departement->nama_departement = $request->nama_departement;
        $departement->save();

        return response()->json(['message' => 'Departemen berhasil disimpan']);
    }

    public function update(Request $request, $id) {
        // Validasi data yang masuk, misalnya nama departemen wajib diisi
        $validatedData = $request->validate([
            'nama_departement' => 'required',
        ]);

        $departement = Departement::find($id);
        $departement->nama_departement = $request->nama_departement;
        $departement->save();

        return response()->json(['message' => 'Departemen berhasil diperbarui']);
    }

    public function destroy($id) {
        $departement = Departement::find($id);
        if ($departement) {
            $departement->delete();
            return response()->json(['message' => 'Departemen berhasil dihapus']);
        } else {
            return response()->json(['message' => 'Departemen tidak ditemukan'], 404);
        }
    }
    
}
