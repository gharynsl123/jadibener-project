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
        $request->validate([
            'id_merek' => 'required',
            'id_kategori' => 'required',
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'image_product' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Simpan data produk ke database
        $product = new Produk();
        $product->id_merek = $request->input('id_merek');
        $product->id_kategori = $request->input('id_kategori');
        $product->kode_produk = $request->input('kode_produk');
        $product->nama_produk = $request->input('nama_produk');
    
        // Proses upload gambar dan simpan pathnya ke database
        if ($request->hasFile('image_product')) {
            $imagePath = $request->file('image_product')->store('images', 'public');
            $product->photo = $imagePath; // Perbaikan field name menjadi 'photo'
        }
    
        $product->save();
    
        // Redirect ke halaman lain atau tampilkan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        //
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
