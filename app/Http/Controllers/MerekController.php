<?php

namespace App\Http\Controllers;

use App\Merek;
use Illuminate\Http\Request;

class MerekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $input = $request->all();
        $merek = Merek::create($input);
        return redirect('/merek');
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
    public function edit(Merek $merek, $nama_merek)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Merek  $merek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merek $merek)
    {
        //
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
        $merek->delete();
        return redirect('/merek');
    }
}
