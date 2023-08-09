<?php

namespace App\Http\Controllers;

use App\Pengajuan;
use App\Urgent;
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
        $urgensi = Urgent::all();
        $user = Auth::user();

        return view('pengajuan.create_pengajuan', compact('peralatan', 'user', 'urgensi'));
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
        $pengajuan['idTikect'] = "P" . $formattedSV;
        $pengajuan['slug'] = Str::slug($pengajuan['idTikect']).'-'.$formatedDate;


        Pengajuan::create($pengajuan);
        // mengambil data dari database pengajuan
        return redirect('/progress')->with('success', 'Pengajuan has been added');
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
        // mengambil data history sesuai dengan id progress
        $history = History::where('id_progress', $pengajuan->id)->get();
        // mengambil data progress berdasarkan id pengajuan yang sudah di setting
        $progress = Progress::where('id_pengajuan', $pengajuan->id)->first();
        $teknisiList = User::where('level', 'teknisi')->get();
        
        return view('pengajuan.detail_pengajuan', compact('teknisiList', 'history','pengajuan', 'progress'));
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
        $pengajuan = Pengajuan::find($id);
        $pengajuan->status = $request->status;
        $pengajuan->save();

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