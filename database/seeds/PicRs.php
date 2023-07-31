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
        $user->name = "ibu hakim";
        $user->email = "hakimasuta@gmail.com";
        $user->level = "pic_rs";
        $user->no_telp = "081299106344";
        $user->role = "manager";
        $user->alamat = "Jl. Kh Hasyim Ashari No.32, RW.8, Cideng, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10150";
        $user->password = \Hash::make('sasani123');
        $user->save();
    }
}
