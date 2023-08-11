<?php

namespace App\Http\Controllers;

use App\Part;
use App\Kategori;
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
        $part= Part::all();
        return view('part.suku_cadang', compact('part', 'kategori'));
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
        $input = $request->all();
        $part = Part::create($input);
        return redirect('/part' ); // Redirect to the newly created suku cadang's details page
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\SukuCadang  $sukuCadang
     * @return \Illuminate\Http\Response
     */
    public function show(SukuCadang $sukuCadang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SukuCadang  $sukuCadang
     * @return \Illuminate\Http\Response
     */
    public function edit(SukuCadang $sukuCadang)
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
    public function update(Request $request, SukuCadang $sukuCadang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SukuCadang  $sukuCadang
     * @return \Illuminate\Http\Response
     */
    public function destroy(SukuCadang $sukuCadang)
    {
        //
    }
}
