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
        $user->nama_user = "rahmat hidayat";
        $user->alamat_user = "Jl. Saturnus Timur No. 20 Margahayu Raya. Desa/Kelurahan, : MANJAHLEGA. Kecamatan/Kota (LN), : KEC. RANCASARI.";
        $user->email = "hidayatalina@gmail.com";
        $user->level = "teknisi";
        $user->role = "kap_teknisi";
        $user->nomor_telepon = "081299106344";
        $user->password = \Hash::make('rahmat987');
        $user->save();
    }
}
