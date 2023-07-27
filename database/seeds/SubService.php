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
        $user->name = "SUB SERVICE";
        $user->email = "subservive@gmail.com";
        $user->level = "sub_service";
        $user->password = \Hash::make('asdasdasd');
        $user->save();
    }
}
