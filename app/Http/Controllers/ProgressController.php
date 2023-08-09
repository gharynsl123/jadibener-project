<?php

namespace App\Http\Controllers;

use App\Progress;
use App\pengajuan;
use Carbon\Carbon;
use App\Peralatan;
use App\History;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProgressController extends Controller
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
        $pengajuan = null;
        // Jika user adalah pic_rs, ambil data pengajuuan berdasarkan user buat. dan jika user adalah admin, ambil semua data peralatan
        if (Auth::user()->level == 'pic_rs') {
            $pengajuan = pengajuan::where('id_user', Auth::user()->id)->get();
        } else {
            $pengajuan = pengajuan::all();
        }
        return view('service.progress', compact('pengajuan'));
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
        
        $progress = $request->all();
        
        
        $today = Carbon::now();
        $formatedDate = $today->format('y-m-d');
        $formattedSV = $today->format('sv');
        $slugvalue = "P" . $formattedSV;
        $progress['slug'] = Str::slug($slugvalue).'-'.$formatedDate;

        Progress::create($progress);
        return redirect('/progress')->with('success', 'Progress has been added');
    }

    public function updateProgress(Request $request, $id)
    {
        $progress = Progress::findOrFail($id);
    
        // Cek jika id_user sudah terisi maka update kolom yang lain
        if (!is_null($progress->id_user)) {
            // Update kolom yang lain


            $progress->progress = $request->progress;
            $progress->keterangan = $request->keterangan;
            // cek jika salah satu dari column tersebut maka upudate kolom yang lain saja dan gunakan value seblumnya
            if ($progress->jadwal == null) {
                $progress->jadwal = $request->jadwal;
            } else {
                $progress->jadwal = $progress->jadwal;
            }

            // Tambahkan update kolom lainnya sesuai kebutuhan
    
            $progress->save();
    
            // Simpan data riwayat
            $history = new History();
            $history->id_user = Auth::user()->id;
            $history->id_progress = $progress->id;
            $history->tanggal = Carbon::now();
            $history->status = "proses"; // Sesuaikan dengan status yang sesuai
            $history->deskripsi = "Progress updated by " . Auth::user()->name;
            $history->save();
    
            return redirect('/progress')->with('success', 'Progress has been updated');
        }
    
        return redirect('/progress')->with('error', 'Progress update failed');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view ('home.detail_progress');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function edit(Progress $progress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Progress $progress)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function destroy(Progress $progress)
    {
        //
    }
}