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
        $user->name = "warato suradi";
        $user->email = "warunasi123.ds@gmail.com";
        $user->level = "teknisi";
        $user->no_telp = "081299106344";
        $user->alamat = "Jl. Kh hurati, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10150";
        $user->password = \Hash::make('warunasi123');
        $user->save();
    }
}
