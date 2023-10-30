<?php

namespace App\Http\Controllers;

use App\Merek;
use App\Kategori;
use App\History;
use App\Pengajuan;
use App\Instansi;
use App\Produk;
use App\Peralatan;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\PeralatanImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
        $peralatan = null;
        
        $kategori = Kategori::all();

        $departemenUser = Auth::user()->departement;
        $userAuth = Auth::user()->id_instansi;
        
        if (Auth::user()->level == 'pic'){
            $peralatan = Peralatan::where('id_instansi', $userAuth)->get();

        } else if (Auth::user()->level == 'pic' && Auth::user()->departement) {
            $peralatan = Peralatan::where('id_instansi', $userAuth)
            ->where('departement', $departemenUser)
            ->get();

            
        } else if (Auth::user()->level == 'pic' && (Auth::user()->departement == 'Purcashing' || Auth::user()->departement == 'IPS-RS')) {
            return view('peralatan.index_peralatan', compact(  'kategori', 'peralatan'));
        }
        else {
            $peralatan = Peralatan::all();
        }

        return view('peralatan.index_peralatan', compact(  'kategori', 'peralatan'));
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
        $peralatan = $request->all();
        $today = Carbon::now();
        $formatedDate = $today->format('y-m-d');
        $peralatan['slug'] = strtoupper(Str::slug($peralatan['serial_number']) . '-' . $formatedDate);

        $dataPeralatan = Peralatan::create($peralatan);
        
        $history = [
            'status_history' => 'Pendataan Alat',
            'deskripsi' => 'Disurvey pada oleh ' . Auth::user()->nama_user,
            'tanggal' => $formatedDate,
        ];
        $history['id_peralatan'] = $dataPeralatan->id;
        $history['id_user'] = $request->id_user;

        History::create($history);

        return redirect('/peralatan')->with('success', 'Data Peralatan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function import(Request $request)
     {
         $file = $request->file('file'); // Ambil file Excel dari formulir
         Excel::import(new PeralatanImport, $file);
         return redirect()->back()->with('success', 'Data berhasil diimpor.');
     }

    public function show($slug)
    {
        // Mengambil data peralatan berdasarkan ID
        $peralatan = Peralatan::where('slug', $slug)->first();
        
        // mengambil data history sesuai id peraltan yang di tuju
        $history = History::where('id_peralatan', $peralatan->id)->get();
        // Mengirim data peralatan ke view
        return view('peralatan.detail_peralatan', compact('peralatan', 'history'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        // Mengambil data peralatan berdasarkan ID
        $peralatan = Peralatan::where('slug', $slug)->first();
        $merek = Merek::all();
        $kategori = Kategori::all();
        $instansi = Instansi::all();
        $product = Produk::all();

        // Mengirim data peralatan ke view
        return view('peralatan.edit_peralatan', compact('peralatan', 'merek', 'kategori', 'instansi', 'product'));
    }

    public function getAjaxInstansi(Request $request) {
        $query = $request->input('q');

        $instansi = Instansi::whereNotNull('jumlah_kasur')
        ->where('nama_instansi', 'LIKE', '%'.$query.'%')
        ->get();
        return response()->json($instansi);
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

        $today = Carbon::now();
        $formatedDate = $today->format('y-m-d');

        $history = [
            'status_history' => 'Alat di survey',
            'deskripsi' => 'Disurvey oleh ' . Auth::user()->nama_user,
            'tanggal' => $formatedDate,
        ];
        $history['id_peralatan'] = $peralatan->id;
        $history['id_user'] = $request->id_user;

        History::create($history);

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