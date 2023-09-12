<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\User;
use Maatwebsite\Excel\Concerns\ToCollection;

class UserImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            user::create([
                'nama_user' => $row[0],
                'level' => $row[1],
                'role' => $row[2],
                'email' => $row[3],
                'alamat_user' => $row[4],
                'nomor_telepon' => $row[5],
                'jenis_kelamin' => $row[6],
                'id_instansi' => $row[7],
                'password' => $row[8],
            ]);
        }
    }
}
