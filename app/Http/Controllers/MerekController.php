<?php

namespace App\Http\Controllers;

use App\Merek;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MerekImport;
use Illuminate\Http\Request;

class MerekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }
     
    public function index()
    {
       return view('part.merk');
    }

    public function dataMerek()
    {
        $merek = Merek::all();
        return response()->json($merek);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $merek = Merek::Insert([
            'nama_merek' => $request->nama_merek,
        ]);
        return response()->json($merek);
    }


    public function import(Request $request)
    {
        $file = $request->file('file'); // Ambil file Excel dari formulir
        Excel::import(new MerekImport, $file);
        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Merek  $merek
     * @return \Illuminate\Http\Response
     */
    public function show(Merek $merek)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Merek  $merek
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $merek = Merek::find($id);
        return response()->json($merek);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Merek  $merek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $merek = Merek::find($id); // Cari merek berdasarkan ID
        // Update data merek
        $merek->nama_merek = $request->nama_merek;
        $merek->save();

        return response()->json($merek);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Merek  $merek
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $merek = Merek::find($id);
    
        if ($merek) {
            $merek->delete();
            return response()->json(['message' => 'Data berhasil dihapus.']);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }
    }
    
}
