<?php

namespace App\Http\Controllers;

use App\Pengajuan;
use App\Kondisi;
use App\Progress;
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
    public function create($id)
    {
        $peralatan = Peralatan::find($id);
        $kondisi = Kondisi::all();
        $user = Auth::user();

        return view('pengajuan.create_pengajuan', compact('peralatan', 'user', 'kondisi'));
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
        
        $today = Carbon::now();
        $formatedDate = $today->format('y-m-d');
        $formattedSV = $today->format('sv');
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
        // mengambil data dari database pengajuan
        return redirect('/peralatan')->with('success', 'Pengajuan has been added');
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
            
        return view('pengajuan.detail_pengajuan', compact('teknisiList', 'historyPengajuan', 'pengajuan', 'progress'));
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
    public function update(Request $request, $id)
    {
        // update status

        $today = Carbon::now();
        $formatedDate = $today->format('y-m-d');

        $pengajuan = Pengajuan::find($id);
        $pengajuan->status_pengajuan = $request->status_pengajuan;
        $update = $pengajuan->save();

        $history = [
            'id_user' => Auth::user()->id,
            'tanggal' => $formatedDate,
            'status_history' => 'masuk ke tahap teknisi',
            'deskripsi' => 'tiket di' . $request->status_pengajuan . ' oleh ' . Auth::user()->nama_user,
        ];
        
        $history['id_pengajuan'] = $pengajuan->id;

        History::create($history);

        // tambah history
        // $history = new History;
        // $history->id_progress = $pengajuan->id;
        // $history->id_user = $pengajuan->user->id;
        // $history->tanggal = Carbon::now();
        // $history->status_history = 'proses';
        // $history->save();

        // ke hlmn home
        return redirect('/home')->with('success', 'Status has been updated');
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