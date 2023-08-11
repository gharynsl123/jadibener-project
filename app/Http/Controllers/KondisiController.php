<?php

namespace App\Http\Controllers;

use App\Kondisi;
use Illuminate\Http\Request;

class KondisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $urgent = Kondisi::all();
        return view('urgent.index_urgent', compact('urgent'));
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
        Kondisi::create($input);
        return redirect('/urgently')->with('success', 'Urgent has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Urgent  $urgent
     * @return \Illuminate\Http\Response
     */
    public function show(Urgent $urgent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Urgent  $urgent
     * @return \Illuminate\Http\Response
     */
    public function edit(Urgent $urgent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Urgent  $urgent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Urgent $urgent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Urgent  $urgent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $urgent = Kondisi::find($id);
        $urgent->delete();
        return redirect('/urgently')->with('success', 'Urgent has been deleted successfully.');
    }
}
