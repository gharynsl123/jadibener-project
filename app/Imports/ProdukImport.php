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
                'id_merek' => $row[0], // Sesuaikan dengan indeks kolom yang sesuai di dalam koleksi
                'id_kategori' => $row[1],
                'kode_produk' => $row[2],
                'nama_produk' => $row[3],
            ]);
        }
    }
}
