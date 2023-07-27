<?php

use Illuminate\Database\Seeder;

class Surveyor extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User;
        $user->name = "SURVEYOR";
        $user->email = "surveyor@gmail.com";
        $user->level = "surveyor";
        $user->password = \Hash::make('asdasdasd');
        $user->save();
    }
}
