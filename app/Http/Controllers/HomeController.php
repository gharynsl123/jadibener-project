<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Instansi;
use App\Progress;
use App\Kategori;
use App\Departement;
use App\User;
use App\Pengajuan;
use App\Peralatan;

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
        $kategori = Kategori::all();
        $depart = Departement::all();
        $peralatan = Peralatan::all();
        $instansi = Auth::user()->instansi;
        // Inisialisasi variabel untuk data pengajuan dan progress
        $pengajuan = null;
        $progress = null;

        // Cek level dan role user
        if ($user->level == 'teknisi' && $user->role == 'kap_teknisi') {
            // Jika user adalah teknisi dengan role kap_teknisi, ambil semua data pengajuan
            $pengajuan = Pengajuan::all();
        } else {
            // Jika user adalah teknisi tanpa role kap_teknisi, ambil data progress sesuai dengan id_pengajuan yang terkait dengan user
            $progress = Progress::where('id_user', $user->id)->get();
        }

        // Ambil semua data pengajuan jika user bukan teknisi atau tidak ada data progress yang diambil di atas
        if ($pengajuan === null) {
            $pengajuan = Pengajuan::where('status_pengajuan', 'pending')->get();
        }

    
        return view('home.admin', compact('instansi', 'peralatan','kategori','user', 'depart', 'progress', 'pengajuan'));
    }

    public function getProcessTicketCount()
    {
        $count = Pengajuan::count(); // Menghitung jumlah pengajuan
        return response()->json(['count' => $count]);
    }

    public function getPendingCount()
    {
        $count = Pengajuan::where('status_pengajuan', 'pending')->count();
        return response()->json(['count' => $count]);
    }

    public function getProsesCount()
    {
        $count = Pengajuan::where('status_pengajuan', 'approved')->count();
        return response()->json(['count' => $count]);
    }

    public function getSolvedCount()
    {
        $count = Pengajuan::where('status_pengajuan', 'selesai')->count();
        return response()->json(['count' => $count]);
    }
    
    
}