<?php

use Illuminate\Database\Seeder;

class Surveyor extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;
        $user->name = "rahmat hidayat";
        $user->email = "hidayatalina@gmail.com";
        $user->level = "surveyor";
        $user->no_telp = "081299106344";
        $user->alamat = "Jl. Saturnus Timur No. 20 Margahayu Raya. Desa/Kelurahan, : MANJAHLEGA. Kecamatan/Kota (LN), : KEC. RANCASARI.";
        $user->password = \Hash::make('rahmat987');
        $user->save();
    }
}
