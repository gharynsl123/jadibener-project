<?php

namespace App\Http\Controllers;

use App\Part;
use App\Kategori;
use Carbon\Carbon;
use App\Pengajuan;
use App\Peralatan;
use Illuminate\Support\Facades\Auth;
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

     public function __construct()
     {
         $this->middleware('auth');
     }
     
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
    public function create($slug)
    {
        $kategori = Kategori::all(); // Get all data from table kategori
        $part = Part::all(); // Get all data from table suku cadang

        // mengambil data peralatan yang dari detail yang di instanisnya di pilih dari detail
        $dataApp = Pengajuan::where('slug', $slug)->first();

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
        $partreq = Part::create($request->all());
        return response()->json($partreq);
    }

    public function dataPart()
    {
        $kategori = Part::all();
        return response()->json($kategori);
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
    public function edit($id)
    {
        $part = Part::find($id);
        return response()->json($part);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SukuCadang  $sukuCadang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $part = Part::find($id);
    
        if (!$part) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }
    
        $part->nama_part = $request->nama_part;
        $part->kode_part = $request->kode_part; // Ubah ini dari $part->nama_part menjadi $part->kode_part
        $part->id_kategori = $request->id_kategori;
        $part->save();
    
        return response()->json($part);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SukuCadang  $sukuCadang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $part = Part::find($id);

        if (!$part) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }

        $part->delete();
        return response()->json(['message' => 'Data berhasil dihapus.']);
    }



    public function storePart(Request $request) {
        $dataReq = $request->all();
        $dataReq['id_peralatan'] = $request->id_peralatan;
        $dataReq['id_instansi'] = $request->id_instansi;
        $dataEstimate = Estimate::create($dataReq);


        $today = Carbon::now();
        $formatedDate = $today->format('y-m-d');
        $history = [
            'id_peralatan' => $request->id_peralatan,
            'status_history' => 'Estimasi Biaya Alat',
            'deskripsi' => 'Diajukan Biaya Oleh ' . Auth::user()->nama_user,
            'id_estimasibiaya' => $dataEstimate->id,
            'tanggal' => $formatedDate,
        ];
        $history['id_user'] = Auth::user()->id;

        History::create($history);

        return redirect('/estimasi-biaya');
    }

    public function estimasi() {
        // jika level dari user itu pic maka tampilkan data yang sesui dengan barangnya saya jika selain dari pic maka tampikan semua data
        if (auth()->user()->level == 'pic') {
            $estimasiData = Estimate::where('id_instansi', Auth::user()->id_instansi)->get();
        } else {
            $estimasiData = Estimate::all();
        }
        return view('service.estimasi', compact('estimasiData'));
    }

    public function destroyPart($id) {
        try {
            // Temukan estimasi biaya berdasarkan ID
            $estimate = Estimate::findOrFail($id);
    
            // Hapus estimasi biaya
            $estimate->delete();
    
            // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
            return redirect()->route('estimate.index')->with('success', 'Estimasi biaya berhasil dihapus.');
        } catch (\Exception $e) {
            // Tangani kesalahan jika diperlukan
            return redirect()->route('estimate.index')->with('error', 'Terjadi kesalahan saat menghapus estimasi biaya.');
        }
    }
}
