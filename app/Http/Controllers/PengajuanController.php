<?php

namespace App\Http\Controllers;

use App\Pengajuan;
use App\Merek;
use App\Produk;
use App\Kategori;
use App\Instansi;
use Illuminate\Support\Facades\Auth;
use App\Peralatan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
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
        $merek = Merek::all();
        $product = Produk::all();
        $kategori = Kategori::all();
        $peralatan = null;

        // Jika user adalah pic_rs, ambil data peralatan berdasarkan rumah sakit yang dipegang
        if (Auth::user()->level == 'pic_rs') {
            $userInstansiId = Auth::user()->id_instansi;
            $peralatan = Peralatan::whereHas('instansi', function ($query) use ($userInstansiId) {
                $query->where('id', $userInstansiId);
            })->get();
        } else {
            // Jika user adalah admin, ambil semua data peralatan
            $peralatan = Peralatan::all();
        }


            return view('pengajuan.index_pengajuan', compact('merek', 'kategori', 'peralatan', 'product'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }
}