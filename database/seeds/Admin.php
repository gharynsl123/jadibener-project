<?php

use Illuminate\Database\Seeder;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = new \App\User;
        $users->nama_user = "super admin";
        $users->alamat_user = "Jl. Kh Hasyim Ashari No.32, RW.8, Cideng, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10150";
        $users->email = "admin@gmail.com";
        $users->jenis_kelamin = "laki-laki";
        $users->level = "admin";
        $users->nomor_telepon = "08129910612";
        $users->password = \Hash::make('admin123');
        $users->save();
    }
}
