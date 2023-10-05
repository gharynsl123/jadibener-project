<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Merek;
use App\Kategori;
use App\Departement;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProdukImport;
use Illuminate\Http\Request;

class ProdukController extends Controller
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
        $mereks = Merek::all();
        $kategoris = Kategori::all();
        $produk = Produk::all();
        return view('product.index_product', compact('produk',  'mereks', 'kategoris'));
    }
    
    public function import(Request $request)
    {
        $file = $request->file('file'); // Ambil file Excel dari formulir
        Excel::import(new ProdukImport, $file);
        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }


    public function create()
    {
        $mereks = Merek::all();
        $kategoris = Kategori::all();
        $departement = Departement::all();

        // Ambil data kategori berdasarkan departemen


        return view('product.create_product', compact('mereks', 'departement', 'kategoris'));
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
        $departement = Departement::all();
        $kategoris = Kategori::all();
        return view('product.edit_product', compact('produk', 'departement','mereks', 'kategoris'));
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

        if ($request->hasFile('photo_produk')) {
            $image = $request->file('photo_produk');
            $image_name = $image->getClientOriginalName();
            $destination_path = 'public/produk'; 
            $path = $request->file('photo_produk')->storeAs($destination_path, $image_name);
            $product->photo_produk = $image_name;
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
    public function destroy($id)
    {
        $product = Produk::find($id);
        $product->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}