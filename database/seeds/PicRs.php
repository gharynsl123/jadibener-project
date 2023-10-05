<?php

use Illuminate\Database\Seeder;

class PicRs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;
        $user->nama_user = "ibu hakim";
        $user->alamat_user = "Jl. Kh Hasyim Ashari No.32, RW.8, Cideng, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10150";
        $user->email = "hakimasuta@gmail.com";
        $user->level = "pic";
        $user->nomor_telepon = "081299106344";
        $user->password = \Hash::make('sasani123');
        $user->save();
    }
}
