<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Peralatan;
use App\User;
use App\Estimate;
use App\Survey;
use App\Pengajuan;
use App\Progress;
use App\Instansi;
use App\History;
use PDF;

class PrintController extends Controller
{
    public function peralatanCetakPdf()
    {
        $peralatan = null;
        $instansi = null;
    
        // Jika user adalah pic_rs, ambil data peralatan berdasarkan rumah sakit yang dipegang. dan jika user adalah admin, ambil semua data peralatan
        if (Auth::user()->level == 'pic') {
            $peralatan = Peralatan::where('id_instansi', Auth::user()->id_instansi)->get();
            $instansi = Instansi::where('id', Auth::user()->id_instansi)->first();
        } else {
            $peralatan = Peralatan::all();
        }
    
        $pdf = PDF::loadView('template-print.peralatan_pdf', ['peralatan' => $peralatan, 'instansi' => $instansi]);
        return $pdf->stream();
    }
    
    public function instansiCetakPdf(Request $request) {
        $instansi = Instansi::all();
    
        $pdf = PDF::loadView('template-print.instansi_pdf', ['instansi' => $instansi]);
        return $pdf->stream();
    }

    public function estimasiCetakPdf($id) {
        $estimasi = Estimate::find($id);

        $pdf = PDF::loadView('template-print.estimasi_pdf', ['estimasi' => $estimasi]);
        return $pdf->stream();
    }

    public function pengajuanCetakPdf($slug){
        $pengajuan = Pengajuan::where('slug', $slug)->first();
    
        // Mengambil data history pengajuan sesuai dengan id pengajuan
        $historyPengajuan = History::where('id_pengajuan', $pengajuan->id)->get();
    
        // Mengambil data progress berdasarkan id pengajuan yang sudah di setting
        $progress = Progress::where('id_pengajuan', $pengajuan->id)->first();
    
        $teknisiList = User::where('level', 'teknisi')->get();
            
        $pdf = PDF::loadView('template-print.pengajuan_pdf', ['teknisiList' => $teknisiList, 'pengajuan' => $pengajuan, 'historyPengajuan' => $historyPengajuan, 'progress' => $progress]);
        return $pdf->stream();
    }

    public function laporanCetakPdf($id) {
    
        $survey = Survey::find($id);
        

        $pdf = PDF::loadView('template-print.laporan_pdf', ['survey' => $survey]);
        return $pdf->stream();
    }

    public function alatCetakPdf($slug){

        $peralatan = Peralatan::where('slug', $slug)->first();
        $history = History::where('id_peralatan', $peralatan->id)->get();

        $pdf = PDF::loadView('template-print.alat_pdf', ['peralatan' => $peralatan, 'history' => $history]);
        return $pdf->stream();
    }
    
    
}