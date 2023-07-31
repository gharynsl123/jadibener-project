<?php

use Illuminate\Database\Seeder;

class SubService extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;
        $user->name = "tardi suradi";
        $user->email = "paktardi@gmail.com";
        $user->level = "sub_service";
        $user->no_telp = "081299106344";
        $user->alamat = "Jl. Kh Hasyim Ashari No.32, RW.8, Cideng, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10150";
        $user->password = \Hash::make('suradi321');
        $user->save();
    }
}
