<?php

namespace App\Http\Controllers;

use App\Progress;
use App\Pengajuan;
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
        if (Auth::user()->level == 'pic') {
            $pengajuan = Pengajuan::where('id_user', Auth::user()->id)->get();
        } else {
            $pengajuan = Pengajuan::all();
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

        $dataProgress = Progress::create($progress);

        // Simpan data riwayat
        $history = [
            'id_user' => Auth::user()->id,
            'tanggal' => Carbon::now(),
            'status_history' => 'progress',
            // mengambil data teknisi yang di berikan di progress
            'deskripsi' => 'progress di ajukan oleh ' . Auth::user()->nama_user . ' kepada ' . $dataProgress->users->nama_user,
            'id_progress' => $dataProgress->id,
            'id_pengajuan' => $request->id_pengajuan,
        ];

        History::create($history);

        if (Auth::user()->level == 'teknisi') {
            return redirect('/home')->with('success', 'Progress has been updated');
        }else{
            return redirect('/progress')->with('success', 'Progress has been updated');
        }
    }

    public function updateProgress(Request $request, $id)
    {
        $progress = Progress::findOrFail($id);
    
        // Cek jika id_user sudah terisi maka update kolom yang lain
        if (!is_null($progress->id_user)) {
            // Update kolom yang lain
            $progress->nilai_pengerjaan = $request->nilai_pengerjaan;
            $progress->keterangan = $request->keterangan;
    
            if ($progress->jadwal == null) {
                $progress->jadwal = $request->jadwal;
                $progress->save();
    
                // Simpan data riwayat
                $historyTime = [
                    'id_user' => Auth::user()->id,
                    'tanggal' => Carbon::now(),
                    'status_history' => 'progress update',
                    'deskripsi' => 'waktu di ajukan oleh ' . Auth::user()->nama_user . ' dengan waktu ' . $progress->jadwal,
                    'id_progress' => $progress->id,
                    'id_pengajuan' => $request->id_pengajuan,
                ];
    
                History::create($historyTime);
            } else {
                // Jika jadwal sudah terisi sebelumnya, tidak perlu merubah jadwal
                $progress->save();
                // Simpan data riwayat
                $history = [
                    'id_user' => Auth::user()->id,
                    'tanggal' => Carbon::now(),
                    'status_history' => 'progress update',
                    'deskripsi' => 'progress di update oleh ' . Auth::user()->nama_user . ' dengan nilai pengerjaan ' . $progress->nilai_pengerjaan . ' dan keterangan ' . $progress->keterangan,
                    'id_progress' => $progress->id,
                    'id_pengajuan' => $request->id_pengajuan,
                ];

                $pengajuan = Pengajuan::findOrFail($request->id_pengajuan);

                if ($progress->nilai_pengerjaan == 100) {
                    $history['status_history'] = 'selesai';
                    $pengajuan->status_pengajuan = 'selesai';
                }
            
                $pengajuan->save();
                History::create($history);
            }
    
            if (Auth::user()->level == 'teknisi') {
                return redirect('/home')->with('success', 'Progress has been updated');
            }
        }
    
        if (Auth::user()->level == 'teknisi') {
            return redirect('/home')->with('success', 'Progress has been updated');
        } else {
            return redirect('/progress')->with('error', 'Progress update failed');
        }
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