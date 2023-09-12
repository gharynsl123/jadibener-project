<?php

namespace App\Http\Controllers;

use App\Kategori;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KategoriImport;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kategori = Kategori::all();
        return view('part.kategori', compact('kategori'));
    }

    public function dataKategori()
    {
        $kategori = Kategori::all();
        return response()->json($kategori);
    }

    public function store(Request $request)
    {
        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return response()->json($kategori);
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return response()->json($kategori);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }

        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return response()->json($kategori);
    }

    public function import(Request $request)
    {
        $file = $request->file('file'); // Ambil file Excel dari formulir
        Excel::import(new KategoriImport, $file);
        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }


    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }

        $kategori->delete();
        return response()->json(['message' => 'Data berhasil dihapus.']);
    }
}
