<?php

namespace App\Imports;

use App\Instansi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class InstansiImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Instansi::create([
                'nama_instansi' => $row[0], // Sesuaikan dengan indeks kolom yang sesuai di dalam koleksi
                'alamat_instansi' => $row[1],
                'jenis_instansi' => $row[2],
            ]);
        }
    }
}
