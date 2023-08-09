<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Merek;
use App\Kategori;
use App\Instansi;
use App\Produk;
use Illuminate\Support\Facades\Auth;
use App\Peralatan;

class PeralatanController extends Controller
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
    
        // Jika user adalah pic_rs, ambil data peralatan berdasarkan rumah sakit yang dipegang. dan jika user adalah admin, ambil semua data peralatan
        if (Auth::user()->level == 'pic_rs') {
            $peralatan = Peralatan::where('id_instansi', Auth::user()->id_instansi)->get();
        } else {
            $peralatan = Peralatan::all();
        }
    
        return view('peralatan.index_peralatan', compact('merek', 'product', 'kategori', 'peralatan'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merek = Merek::all();
        $kategori = Kategori::all();
        $instansi = Instansi::all();
        $product = Produk::all();
        return view('peralatan.create_peralatan', compact('merek', 'kategori', 'instansi', 'product'));
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
        Peralatan::create($input);
        return redirect('/peralatan')->with('success', 'Data Peralatan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          // Mengambil data peralatan berdasarkan ID
    $peralatan = Peralatan::find($id);

    // Mengirim data peralatan ke view
    return view('peralatan.detail_peralatan', compact('peralatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Mengambil data peralatan berdasarkan ID
        $peralatan = Peralatan::find($id);
        $merek = Merek::all();
        $kategori = Kategori::all();
        $instansi = Instansi::all();
        $product = Produk::all();

        // Mengirim data peralatan ke view
        return view('peralatan.edit_peralatan', compact('peralatan', 'merek', 'kategori', 'instansi', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                // Mengambil data peralatan berdasarkan ID
                $peralatan = Peralatan::find($id);
                $peralatan->update($request->all());
                return redirect('/peralatan')->with('success', 'Data Peralatan Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peralatan = Peralatan::find($id);
        $peralatan->delete();
        return redirect('/peralatan')->with('success', 'Data Peralatan Berhasil Dihapus');
    }
}