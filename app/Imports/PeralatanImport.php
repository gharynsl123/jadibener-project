<?php

namespace App\Imports;

use App\Peralatan;
use Carbon\Carbon;
use App\History;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;

class PeralatanImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $timezone = 'Asia/Jakarta';

            $today = Carbon::now($timezone);
            $formatedDate = $today->format('y-m-d');

            $peralatan = [
                'id_instansi' => $row[0],
                'id_merek' => $row[1],
                'id_product' => $row[2],
                'serial_number' => $row[3],
                'tahun_pemasangan' => $row[4],
                'produk_dalam_kondisi' => $row[5],
                'id_kategori' => $row[6],
                'usia_barang' => $row[7],
                'departement' => $row[8],
            ];

            // Tambahkan logika untuk membuat slug di sini
            $peralatan['slug'] = strtoupper(Str::slug($peralatan['serial_number']) . '-' . $formatedDate);
            $peralatan['id_user'] = auth()->user()->id;
            
            // Buat data peralatan dan dapatkan instance
            $dataPeralatan = Peralatan::create($peralatan);

            // Buat data history
            $history = [
                'status_history' => 'Pendataan Alat',
                'deskripsi' => 'Disurvey pada oleh ' . Auth::user()->nama_user,
                'tanggal' => $formatedDate,
            ];
            $history['id_peralatan'] = $dataPeralatan->id;
            $history['id_user'] = auth()->user()->id;

            // Buat record history
            History::create($history);
        }
    }
}
