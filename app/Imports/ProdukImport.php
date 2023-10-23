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
                'id_merek' => '2', // Sesuaikan dengan indeks kolom yang sesuai di dalam koleksi
                'id_kategori' => '2',
                'kode_produk' => $row[0],
                'nama_produk' => $row[1],
            ]);
        }
    }
}
