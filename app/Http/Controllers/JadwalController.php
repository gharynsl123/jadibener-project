<?php

namespace App\Http\Controllers;

use App\Jadwal;
use App\User;
use App\History;
use App\Peralatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JadwalController extends Controller
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
        $jadwal = null;
        // jika user adalah pic maka ambil data jadwal yang sesuai dengan id intnasi yang di pegang oleh pic tersebut
        if (Auth::user()->level == 'pic') {
            $jadwal = Jadwal::where('id_instansi', Auth::user()->id_instansi)->get();
        } else {
            $jadwal = Jadwal::all();
        }
        return view('service.jadwal', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $peralatan = Peralatan::all();
        $teknisi = User::where('level', 'teknisi')->get();
        $dataApp = Peralatan::where('slug', $slug)->first();
        return view('jadwal.create_jadwal_teknisi', compact('dataApp', 'teknisi', 'peralatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Jadwal::create($request->all());
        // kemabali ke page detail peralatan yang di pilih 
        return redirect()->route('peralatan.show')->with('success', 'Jadwal berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
