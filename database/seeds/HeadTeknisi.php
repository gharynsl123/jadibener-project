<?php

use Illuminate\Database\Seeder;

class HeadTeknisi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;
        $user->nama_user = "kitamasur";
        $user->alamat_user = "Jl. Saturnus Timur No. 20 Margahayu Raya. Desa/Kelurahan, : MANJAHLEGA. Kecamatan/Kota (LN), : KEC. RANCASARI.";
        $user->email = "kitamasur@gmail.com";
        $user->level = "teknisi";
        $user->role = "kap_teknisi";
        $user->nomor_telepon = "081299106344";
        $user->password = \Hash::make('kitamasur123');
        $user->save();
    }
}
