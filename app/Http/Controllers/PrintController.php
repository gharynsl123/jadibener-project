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
        $user = Auth::user();
    
        $departemenUser = Auth::user()->id_departement;
        $userAuth = Auth::user()->id_instansi;
        
        if (Auth::user()->level == 'pic' && (Auth::user()->departement->nama_departement == 'Purchasing' || Auth::user()->departement->nama_departement == 'IPS-RS')) {
            $peralatan = Peralatan::where('id_instansi', $userAuth)->get();
            $instansi = Instansi::where('id', Auth::user()->id_instansi)->first();
            
        } else if (Auth::user()->level == 'pic' && Auth::user()->departement->nama_departement) {
            $peralatan = Peralatan::where('id_instansi', $userAuth)
            ->where('id_departement', $departemenUser)
            ->get();
            $instansi = Instansi::where('id', Auth::user()->id_instansi)->first();

        } else {
            $peralatan = Peralatan::all();
        }
    
        $pdf = PDF::loadView('template-print.peralatan_pdf', ['peralatan' => $peralatan,'user' => $user, 'instansi' => $instansi]);
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
    
    public function ProfileRs() {
        
        $user = Auth::user();
        $instansi = Auth::user()->instansi;

        $pdf = PDF::loadView('template-print.account_rs_pdf', ['instansi' => $instansi, 'user' => $user]);
        return $pdf->stream();
    }
}