<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\User;
use Illuminate\Support\Facades\Hash;
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
                'email' => $row[1],
                'level' => $row[2],
                'alamat_user' => $row[3],
                'nomor_telepon' => $row[4],
                'jenis_kelamin' => $row[5],
                'password' => Hash::make($row[6]),
                'id_instansi' => $row[7],
            ]);
        }
    }
}
