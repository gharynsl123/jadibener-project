<?php

namespace App\Imports;

use App\Kategori;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class KategoriImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Kategori::create([
                'nama_kategori' => $row[0],
            ]);
        }
    }
}
