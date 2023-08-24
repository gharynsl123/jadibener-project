<?php

namespace App\Http\Controllers;

use App\Part;
use App\Kategori;
use App\Pengajuan;
use App\Peralatan;
use App\History;
use App\Estimate;
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
    public function create()
    {
        $kategori = Kategori::all(); // Get all data from table kategori
        $part = Part::all(); // Get all data from table suku cadang
        $dataApp = History::where('id_progress')->get()->first();
        return view('pengajuan.estimasi_part', compact('part', 'kategori', 'dataApp')); // Redirect to the create suku cadang's page with the data from table kategori and suku cadang
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

    public function storePart(Request $request) {
        $dataReq = $request->all();
        $dataReq['id_peralatan'] = $request->id_peralatan;
        Estimate::create($dataReq);
        return redirect('/estimasi-biaya');
    }

    public function estimasi() {
        $estimasiData = Estimate::all();
        return view('service.estimasi', compact('estimasiData'));
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
