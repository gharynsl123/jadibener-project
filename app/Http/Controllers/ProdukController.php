<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Merek;
use App\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mereks = Merek::all();
        $kategoris = Kategori::all();
        $produk = Produk::all();
        return view('product.index_product', compact('produk', 'mereks', 'kategoris'));
    }
    
    public function create()
    {
        $mereks = Merek::all();
        $kategoris = Kategori::all();
    
        return view('product.create_product', compact('mereks', 'kategoris'));
    }
    
    public function store(Request $request)
    {
        // Simpan data produk ke database
        $addDataProduk = $request->all();
    
        if($request->hasFile('photo_produk')){
            $destination_path = 'public/produk'; //path tempat penyimpanan (storage/public/images/profile)
            $image = $request -> file('photo_produk'); //mengambil request column photo_instansi
            $image_name = $image->getClientOriginalName(); //memberikan nama gambar yang akan disimpan di foto
            $path = $request->file('photo_produk')->storeAs($destination_path, $image_name); //mengirimkan foto ke folder store
            $addDataProduk['photo_produk'] = $image_name; //mengirimkan ke database
        }
    
        Produk::create($addDataProduk);
    
        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }
    


    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            
            $produk = Produk::find($id);
            $mereks = Merek::all();
            $kategoris = Kategori::all();
            return view('product.detail_product', compact('produk', 'mereks', 'kategoris'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $produk = Produk::find($id);
        $mereks = Merek::all();
        $kategoris = Kategori::all();
        return view('product.edit_product', compact('produk', 'mereks', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // update data yang telah di isi
        $product = Produk::find($id);
        $product->id_merek = $request->input('id_merek');
        $product->id_kategori = $request->input('id_kategori');
        $product->kode_produk = $request->input('kode_produk');
        $product->nama_produk = $request->input('nama_produk');

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image_name = $image->getClientOriginalName();
            $destination_path = 'public/images';
            $path = $request->file('photo')->storeAs($destination_path, $image_name);
            $product->photo = $image_name;
        }

        $product->save();

        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //
    }
}