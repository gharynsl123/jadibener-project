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
        $user->name = "PIC RS";
        $user->email = "picrs@gmail.com";
        $user->level = "pic_rs";
        $user->password = \Hash::make('asdasdasd');
        $user->save();
    }
}
