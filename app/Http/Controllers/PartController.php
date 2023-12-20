<?php

namespace App\Http\Controllers;

use App\Part;
use App\History;
use App\Kategori;
use App\Pengajuan;
use App\Peralatan;
use App\Estimate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $dataApp = Peralatan::where('slug', $slug)->first();

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
        $partreq = $request->all();
        $partreq['slug'] = Str::slug($request->nama_part).'-'.($request->kode_part);

        // Proses upload dan menyimpan gambar
        if ($request->hasFile('photo')) {
            $destination_path = 'public/part';
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $request->file('photo_produk')->storeAs($destination_path, $image_name); //mengirimkan foto ke folder store
            // Simpan nama gambar ke dalam field 'photo' di database
            $partreq['photo'] = $imageName;
        }
        


        Part::create($partreq);
        return redirect()->back();
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
    public function show($slug)
    {
        $part = Part::where('slug', $slug)->first();
        return view('part.detail_part', compact('part'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SukuCadang  $sukuCadang
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $part = Part::where('slug', $slug)->first();
        $kategori = Kategori::all();
        return view('part.edit_part', compact('part', 'kategori'));

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
        $part = $request->all();

        $part->save();
        return redirect('/part');
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

        $part->delete();
        return redirect()->back();
    }



    public function storePart(Request $request) {
    
        $data = $request->all();
    
        // Check if 'berkas_photo' file is present in the request
        if ($request->hasFile('berkas_photo')) {
            $destination_path = 'public/produk';
            $image = $request->file('berkas_photo');
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs($destination_path, $image_name);
            $data['berkas_photo'] = $image_name;
        }        
    
        // Create a new estimate with the uploaded image
        $data['id_peralatan'] = $request->id_peralatan;
        $data['id_instansi'] = $request->id_instansi;
        $dataEstimate = Estimate::create($data);


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
