<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Admin::class);
        $this->call(PicRs::class);
        $this->call(SubService::class);
        $this->call(Teknisi::class);
        $this->call(Surveyor::class);
        $this->call(InstansiSeeder::class);
        $this->call(HeadTeknisi::class);
    }
}
