<?php

namespace App\Http\Controllers;

use App\Pengajuan;
use App\Progress;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPengajuan;
use App\User;
use App\History;
use Carbon\Carbon;
use App\Peralatan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
    //     
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $slug)
    {
        $peralatan = Peralatan::where('slug', $slug)->first();
        $user = Auth::user();

        return view('pengajuan.create_pengajuan', compact('peralatan', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // membuat data masuk ke database pengajuan dengan singkat
        $pengajuan = $request->all();
        
        $peralatan = Peralatan::find($request->id_peralatan);
        
        $today = Carbon::now();
        $formatedDate = $today->format('d-m-Y');
        $formattedSV = $today->format('ymdsv');
        $pengajuan['id_pengenal'] = "P" . $formattedSV;
        $pengajuan['slug'] = Str::slug($pengajuan['id_pengenal']).'-'.$formatedDate;

        $dataPengajuan = Pengajuan::create($pengajuan);
        // membuat data history untuk di tampilkan di detail pengajuan
        $history = [
            'id_user' => Auth::user()->id,
            'tanggal' => $formatedDate,
            'status_history' => 'pengajuan baru' ,
            'deskripsi' => 'pengajuan di buat oleh ' . Auth::user()->nama_user,
        ];
        $history['id_peralatan'] = $request->id_peralatan;

        $history['id_pengajuan'] = $dataPengajuan->id;

        History::create($history);
    

        return redirect()->route('peralatan.index');
        // mengambil data dari database pengajuan
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $pengajuan = Pengajuan::where('slug', $slug)->first();
        
        // Mengambil data history pengajuan sesuai dengan id pengajuan
        $historyPengajuan = History::where('id_pengajuan', $pengajuan->id)->get();
    
        // Mengambil data progress berdasarkan id pengajuan yang sudah di setting
        $progress = Progress::where('id_pengajuan', $pengajuan->id)->first();
    
        $teknisiList = User::where('level', 'teknisi')->get();
            
        return view('pengajuan.detail_pengajuan', compact('teknisiList','historyPengajuan', 'pengajuan', 'progress'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update status pengajuan
        $pengajuan = Pengajuan::find($id);
        $pengajuan->status_pengajuan = $request->status_pengajuan;
        $pengajuan->save();
    
        // Tambahkan history
        $today = Carbon::now();
        $formattedDate = $today->format('y-m-d');
    
        $history = [
            'id_user' => Auth::user()->id,
            'tanggal' => $formattedDate,
            'status_history' => 'masuk ke tahap teknisi',
            'deskripsi' => 'tiket di ' . $request->status_pengajuan . ' oleh ' . Auth::user()->nama_user,
        ];
    
        $history['id_pengajuan'] = $pengajuan->id;
    
        History::create($history);
    
        // Berikan respon untuk Ajax
        return redirect('/home')->with('success', 'Data Peralatan Berhasil Diupdate');
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