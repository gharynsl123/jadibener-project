<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Instansi;
use App\Progress;
use App\User;
use App\Pengajuan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $instansi = Auth::user()->instansi;
        $pengajuan = Pengajuan::all();
        
        $progress = null;
    
        // Jika user adalah pic_rs, ambil data peralatan berdasarkan rumah sakit yang dipegang. dan jika user adalah admin, ambil semua data peralatan
        if (Auth::user()->level == 'pic_rs') {
            $progress = Progress::where('id_user', Auth::user()->id_pengajuan)->get();
        } else {
            $progress = Progress::all();
        }
    
        return view('home.admin', compact('instansi', 'user', 'progress', 'pengajuan'));
    }
}