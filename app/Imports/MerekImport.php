<?php

namespace App\Imports;

use App\Merek;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MerekImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Merek::create([
                'nama_merek' => $row[0],
            ]);
        }
    }
}
