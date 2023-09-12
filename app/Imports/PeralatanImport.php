<?php

namespace App\Imports;

use App\Peralatan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PeralatanImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Peralatan::create([
                'nama_kategori' => $row[0],
            ]);
        }
    }
}
