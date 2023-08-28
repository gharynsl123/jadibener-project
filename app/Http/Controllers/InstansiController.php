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
        
        $dataInstansi = $request->all();
        // apploud image to data base and local

        if($request->hasFile('photo_instansi')){
            $destination_path = 'public/rumahsakit'; //path tempat penyimpanan (storage/public/images/profile)
            $image = $request -> file('photo_instansi'); //mengambil request column photo_instansi
            $image_name = $image->getClientOriginalName(); //memberikan nama gambar yang akan disimpan di foto
            $path = $request->file('photo_instansi')->storeAs($destination_path, $image_name); //mengirimkan foto ke folder store
            $dataInstansi['photo_instansi'] = $image_name; //mengirimkan ke database
        }

        Instansi::create($dataInstansi);

        return redirect('/instansi')->with('success', 'Data rumah sakit berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $instansi = Instansi::find($id);
        // mengambil data yang ada di table instasi dengan user yang sedang login
        $user = User::where('id_instansi', $instansi->id)->get()->all();
        return view('instansi.detail_instansi', compact('user', 'instansi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // edit intansi
        $instansi = Instansi::find($id);

        $user = User::where('level', 'pic')->get();
        return view('instansi.edit_instansi', compact('instansi', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instansi  $instansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $instansi = Instansi::find($id);
        $dataInstansi = $request->all();
        // apploud image to data base and local

        if($request->hasFile('photo_instansi')){
            $destination_path = 'public/rumahsakit'; //path tempat penyimpanan (storage/public/images/profile)
            $image = $request -> file('photo_instansi'); //mengambil request column photo_instansi
            $image_name = $image->getClientOriginalName(); //memberikan nama gambar yang akan disimpan di foto
            $path = $request->file('photo_instansi')->storeAs($destination_path, $image_name); //mengirimkan foto ke folder store
            $dataInstansi['photo_instansi'] = $image_name; //mengirimkan ke database
        } else{
            $dataInstansi['photo_instansi'] = $instansi->photo_instansi;
        }

        $instansi->update($dataInstansi);

        return redirect('/instansi')->with('success', 'Data rumah sakit berhasil diubah.');
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