<?php

namespace App\Http\Controllers;

use App\Instansi;
use Illuminate\Http\Request;
use App\User;

class InstansiController extends Controller
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
        $instansi = Instansi::all();
        $user = User::all();
        return view('instansi.index_instansi', compact('instansi', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('level', 'pic_rs')->get();
        return view('instansi.create_instansi', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'instansi' => 'required|string|max:255',
            'id_user' => 'required|exists:users,id',
            'jumlah_kasur' => 'required|integer|min:0',
            'kelas' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat' => 'required|string',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Instansi::create([
            'instasi' => $request->instansi,
            'alamat' => $request->alamat,
            'id_user' => $request->id_user,
            'jumlah_kasur' => $request->jumlah_kasur,
            'kelas' => $request->kelas,
            'status' => $request->status,
            'photo' => $imagePath,
        ]);

        return redirect('/instansi')->with('success', 'Data rumah sakit berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function show(Instansi $instansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function edit(Instansi $instansi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instansi $instansi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instansi = Instansi::find($id);
        $instansi->delete();
        return redirect('/instansi');
    }
}