<?php

namespace App\Http\Controllers;

use App\Part;
use App\Kategori;
use App\Pengajuan;
use App\Peralatan;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        $part = Part::all();
        return view('part.suku_cadang', compact('part', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $kategori = Kategori::all(); // Get all data from table kategori
        $part = Part::all(); // Get all data from table suku cadang
        // ambil data peralatan sesuai dengan pengajuan yang di pilih tadi sebelum ke pengajuan pergantian part
        $peralatan = Peralatan::find($id);
        
        return view('pengajuan.estimasi_part', compact('part', 'kategori', 'peralatan')); // Redirect to the create suku cadang's page with the data from table kategori and suku cadang
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Part::create($request->all());
        return redirect('/part'); // Redirect to the newly created suku cadang's details page
    }

    public function storeParrt(Request $request) {
        
    }

    public function estimasi() {
        return view('service.estimasi');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\SukuCadang  $sukuCadang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $part = Part::find($id);
        return view('part.detail_part', compact('part'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SukuCadang  $sukuCadang
     * @return \Illuminate\Http\Response
     */
    public function edit(Part $part)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SukuCadang  $sukuCadang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Part $part)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SukuCadang  $sukuCadang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $part = Part::find($id);
        $part->delete();
        return redirect('/part'); // Redirect to the suku cadang's list page
    }
}
