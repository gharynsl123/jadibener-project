<?php

use Illuminate\Database\Seeder;
use App\Merek;

class MerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $merek = [
            [
                'nama_merek' => 'beurer',
            ],
            [
                'nama_merek' => 'alcoscan',
            ],
            [
                'nama_merek' => 'edan',
            ],
            [
                'nama_merek' => 'omron',
            ],
            [
                'nama_merek' => 'rossmax',
            ],
        ];

        // Insert the data into the users table
        foreach ($merek as $addItems) {
            Merek::create($addItems);
        }
    }
}
