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
        $users->name = "super admin";
        $users->email = "admin@gmail.com";
        $users->level = "admin";
        $users->alamat = "Jl. Kh Hasyim Ashari No.32, RW.8, Cideng, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10150";
        $users->no_telp = "08129910612";
        $users->password = \Hash::make('admin123');
        $users->save();
    }
}
