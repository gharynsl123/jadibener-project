<?php

namespace App\Imports;


use App\Produk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProdukImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Produk::create([
                'kode_produk' => $row[0],
                'nama_produk' => $row[1],
                'id_merek' =>  $row[2], // Sesuaikan dengan indeks kolom yang sesuai di dalam koleksi
                'id_kategori' =>  $row[3],
                'departement' =>  $row[4],
            ]);
        }
    }
}
