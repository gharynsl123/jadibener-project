<?php

use Illuminate\Database\Seeder;
use App\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = [
            [
                'nama_kategori' => 'Kompor',
            ],
            [
                'nama_kategori' => 'cssd',
            ],
            [
                'nama_kategori' => 'makanan',
            ],
            [
                'nama_kategori' => 'minuman',
            ],
            [
                'nama_kategori' => 'trolley',
            ],
        ];
        // Insert the data into the users table
        Kategori::insert($kategori);
    }
}
