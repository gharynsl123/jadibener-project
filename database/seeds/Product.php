<?php

use Illuminate\Database\Seeder;
use App\Produk;
use App\Kategori;
use App\Merek;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class Product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch existing kategori and merek records
        $kategori = Kategori::all();
        $mereks = Merek::all();

        $produk = [
            [
                'nama_produk' => 'Alat Cek Darah',
                'kode_produk' => 'B12567',
                'photo_produk' => 'paek.png',
                'id_kategori' => $kategori[0]->id,
                'id_merek' => $mereks[0]->id,
            ],
            [
                'nama_produk' => 'Tensimeter',
                'kode_produk' => '1D0234',
                'photo_produk' => 'pengajuan.png',
                'id_kategori' => $kategori[1]->id,
                'id_merek' => $mereks[1]->id,
            ],
            [
                'nama_produk' => 'Termometer Medis',
                'kode_produk' => '111027',
                'photo_produk' => 'cikoko.png',
                'id_kategori' => $kategori[2]->id,
                'id_merek' => $mereks[2]->id,
            ],
        ];
        
        foreach ($produk as $addItems) {

            Produk::create($addItems);
        }
    }
}
