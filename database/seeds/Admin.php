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
        $users->name = "superadmindmin";
        $users->email = "admin@gmail.com";
        $users->level = "admin";
        $users->password = \Hash::make('asdasdasd');
        $users->save();
    }
}
