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
        $user->name = "TEKNISI";
        $user->email = "admteknisiin@gmail.com";
        $user->level = "teknisi";
        $user->password = \Hash::make('asdasdasd');
        $user->save();
    }
}
