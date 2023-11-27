<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instansi;
use App\ReqMember;
use Illuminate\Support\Facades\Hash;
use App\User;

class ReqMemberContrroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index() {
        $member = ReqMember::all();
        return view ('service.member_req', compact('member'));
    }

    public function approve($id) {
        // Ambil data dari ReqMember berdasarkan ID yang diberikan.
        $reqMember = ReqMember::findOrFail($id);
    
        // Buat instance User dan isi dengan data yang sesuai.
        $user = new User;
        $user->nama_user = $reqMember->nama_user;
        $user->email = $reqMember->email;
        $user->nomor_telepon = $reqMember->nomor_telepon;
        $user->jenis_kelamin = $reqMember->jenis_kelamin;
        $user->level = 'pic';
        $user->password = Hash::make($reqMember->password);
        $user->departement = $reqMember->departement;
    
        // Simpan data User ke dalam tabel user.
        $user->save();
    
        // Hapus data dari ReqMember setelah disetujui.
        $reqMember->delete();
    
        // Redirect kembali ke halaman awal dengan pesan sukses.
        return redirect()->route('service.member_req')->with('success', 'Permintaan disetujui dan data telah ditambahkan ke User.');
    }

    public function reject($id) {
        $reqMember = ReqMember::findOrFail($id);
        $reqMember->delete();

        return redirect()->route('service.member_req')->with('success', 'Data Berhasil di tolak. akan di infomasi kan ke pengguna');
    }
    
    public function detail($id) {
        $reqMember = ReqMember::findOrFail($id);
        return response()->json($reqMember);
    }
}
