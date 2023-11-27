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
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PeralatanController extends Controller
{

    // authorization
    public function __construct() { $this->middleware('auth'); }

    // index page configuration
    public function index() {
        $peralatan = null;        

        $kategori = Kategori::all();
        $userAuth = Auth::user()->id_instansi;
        $departemenUser = Auth::user()->departement;
        
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

    // create page
    public function create() {
        $merek = Merek::all();
        $product = Produk::all();
        $kategori = Kategori::all();
        $instansi = Instansi::all();

        return view('peralatan.create_peralatan', compact('merek', 'kategori', 'instansi', 'product'));
    }

    // detail page
    public function show($slug) {
        $peralatan = Peralatan::where('slug', $slug)->first();
        $history = History::where('id_peralatan', $peralatan->id)->get();

        return view('peralatan.detail_peralatan', compact('peralatan', 'history'));
    }


    // edit page
    public function edit($slug) {
        $merek = Merek::all();
        $product = Produk::all();
        $kategori = Kategori::all();
        $instansi = Instansi::all();
        $peralatan = Peralatan::where('slug', $slug)->first();

        return view('peralatan.edit_peralatan', compact('peralatan', 'merek', 'kategori', 'instansi', 'product'));
    }

    // function store action
    public function store(Request $request) {

        try {
            $peralatan = $request->all();
            $timezone = 'Asia/Jakarta';

            $today = Carbon::now($timezone);
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
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error saving user data.')->withInput();
        }
        
    }

    // function update action
    public function update(Request $request, $id) {

        try {
            $peralatan = Peralatan::find($id);
            $peralatan->update($request->all());
    
            $timezone = 'Asia/Jakarta';
            $today = Carbon::now($timezone);
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
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Error saving user data.')->withInput();
        }
    }

    // function delete action
    public function destroy($id) {
        $peralatan = Peralatan::find($id);
        $peralatan->delete();
        return redirect('/peralatan')->with('success', 'Data Peralatan Berhasil Dihapus');
    }

    // function ajax data instansi
    public function getAjaxInstansi(Request $request) {
        $query = $request->input('q');

        $instansi = Instansi::whereNotNull('jumlah_kasur')
        ->where('nama_instansi', 'LIKE', '%'.$query.'%')
        ->get();
        return response()->json($instansi);
    }

    // function detail alat
    public function getAlatDetails($id) {
       // Ambil informasi tambahan dari database berdasarkan ID user
       $peralatan = Peralatan::find($id);

       // Misalnya, Anda dapat mengembalikan informasi dalam format HTML
       $details = '<p>Nama Produk: <strong>' . $peralatan->produk->nama_produk . '</strong></p>' .
                   '<p>Nama Instansi: <strong>' . $peralatan->instansi->nama_instansi . '</strong></p>' .
                   '<p>Kategori Peralatan: <strong>' . $peralatan->kategori->nama_kategori . '</strong></p>' .
                   '<p>Departemen: <strong>' . $peralatan->departement . '</strong></p>' .
                   '<p>Merek Peralatan: <strong>' . $peralatan->merek->nama_merek . '</strong></p>' ;

       return $details;
    }

    // function import
    public function import(Request $request) {
        $file = $request->file('file'); // Ambil file Excel dari formulir
        Excel::import(new PeralatanImport, $file);
        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }
}