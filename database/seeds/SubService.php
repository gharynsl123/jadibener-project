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
        $user->nama_user = "tardi suradi";
        $user->alamat_user = "Jl. Kh Hasyim Ashari No.32, RW.8, Cideng, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10150";
        $user->email = "paktardi@gmail.com";
        $user->level = "sub_service";
        $user->nomor_telepon = "081299106344";
        $user->password = \Hash::make('suradi321');
        $user->save();
    }
}
