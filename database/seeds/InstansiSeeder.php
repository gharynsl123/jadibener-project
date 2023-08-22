<?php

use Illuminate\Database\Seeder;
use App\Instansi;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch existing kategori and merek records

        $instansi = [
            [
                'nama_instansi' => 'Rumah Sakit Mitra Keluarga Group',
                'alamat_instansi' => 'Jl. Raya Gading Kirana No.2, RT.18/RW.8, Klp. Gading Bar., Kec. Klp. Gading, Jkt Utara, Daerah Khusus Ibukota Jakarta 14240',
                'photo_instansi' => 'djumazz.png',
                'jenis_instansi' => 'pemerintah',
                'jumlah_kasur' => '567',
            ],
            [
                'nama_instansi' => 'Siloam Hospitals Group',
                'alamat_instansi' => 'Jl. Letjen Suprapto No.1, RT.10/RW.7, Cemp. Putih Tim., Kec. Cemp. Putih, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10510',
                'photo_instansi' => 'medhigen.png',
                'jenis_instansi' => 'pemerintah',
                'jumlah_kasur' => '567',
            ],
            [
                'nama_instansi' => 'Rumah Sakit Dr. Oen Surakarta',
                'alamat_instansi' => 'Jl. Brigjend Katamso No.55, Tegalharjo, Kec. Jebres, Kota Surakarta, Jawa Tengah 57128',
                'photo_instansi' => 'helem.png',
                'jenis_instansi' => 'pemerintah',
                'jumlah_kasur' => '567',
            ],
            [
                'nama_instansi' => 'Rumah Sakit Bunda Jakarta',
                'alamat_instansi' => 'Jl. Teuku Cik Ditiro No.21, RT.9/RW.2, Gondangdia, Kec. Menteng, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10350',
                'photo_instansi' => 'cikoko.png',
                'jenis_instansi' => 'pemerintah',
                'jumlah_kasur' => '567',
            ],
        ];
        
        foreach ($instansi as $addItems) {

            Instansi::create($addItems);
        }
    }
}
