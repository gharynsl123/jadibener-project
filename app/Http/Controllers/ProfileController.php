<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Instansi;
use App\User;
use App\ReqSurveyor;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // aut
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        // mengambil data user yang sedang login
        $user = User::where('id', Auth::user()->id)->first();
        // Cari permintaan surveyor terbaru untuk pengguna ini
        $latestRequest = ReqSurveyor::where('id_user', $user->id)
        ->orderBy('created_at', 'desc')
        ->first();

        // mengambil data yang ada di table instasi dengan user yang sedang login
        $instansi = Instansi::where('id', Auth::user()->id_instansi)->get()->all();
            
        // memunculkan data ke view
        return view('profile.account', compact('instansi', 'user', 'latestRequest'));
    }


    public function reqStore(Request $req, $id) {
        $user = Auth::user();
        // Pastikan pengguna hanya dapat mengajukan permintaan jika mereka adalah teknisi
        if ($user->level === 'teknisi') {
            ReqSurveyor::create([
                'id_user' => $user->id,
                'state' => 'pending',
            ]);

            // Tambahkan timestamp permintaan terakhir ke kolom requested_at
            $user->update([
                'created_at' => now(),
            ]);
        }

        return redirect()->route('profile.index');
    }

    public function approveSurveyor(User $user)
    {
        $user->level = 'surveyor';
        $user->save();
    
        // Cari rekaman ReqSurveyor terkait yang masih dalam status 'pending'
        $reqSurveyor = ReqSurveyor::where('state', 'pending')->first();
    
        // Periksa apakah ReqSurveyor ditemukan sebelum memperbarui statusnya
        if ($reqSurveyor) {
            $reqSurveyor->update([
                'state' => 'approve',
            ]);
        }
    
        // Redirect kembali ke halaman "Suveyor Request" atau halaman lain yang sesuai
        return redirect()->route('home');
    }

    public function rejectSurveyor(User $user)
    {
        // Cari rekaman ReqSurveyor terkait
        $reqSurveyor = ReqSurveyor::where('state', 'pending')->first();
    
        // Periksa apakah ReqSurveyor ditemukan sebelum memperbarui statusnya
        if ($reqSurveyor) {
            $reqSurveyor->update([
                'state' => 'reject',
            ]);
        }
    
        // Redirect kembali ke halaman "Suveyor Request" atau halaman lain yang sesuai
        return redirect()->route('home');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
