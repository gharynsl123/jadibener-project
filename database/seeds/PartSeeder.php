<?php

use Illuminate\Database\Seeder;
use App\Part;
use App\Kategori;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch existing kategori and merek records
        $kategori = Kategori::all();

        $part = [
            [
                'nama_part' => 'Alat Cek Darah',
                'kode_part' => 'B12567',
                'id_kategori' => $kategori[0]->id,
            ],
            [
                'nama_part' => 'Tensimeter',
                'kode_part' => '1D0234',
                'id_kategori' => $kategori[1]->id,
            ],
            [
                'nama_part' => 'Termometer Medis',
                'kode_part' => '111027',
                'id_kategori' => $kategori[1]->id,
            ],
        ];
        
        foreach ($part as $addItems) {
            Part::create($addItems);
        }
    }
}
