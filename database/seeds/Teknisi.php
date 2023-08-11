<?php

use Illuminate\Database\Seeder;

class Teknisi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;
        $user->nama_user = "warato suradi";
        $user->email = "warunasi123.ds@gmail.com";
        $user->level = "teknisi";
        $user->nomor_telepon = "081299106344";
        $user->alamat_user = "Jl. Kh hurati, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10150";
        $user->password = \Hash::make('warunasi123');
        $user->save();
    }
}
