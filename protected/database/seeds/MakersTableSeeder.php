<?php

use App\Maker;
use Illuminate\Database\Seeder;

class MakersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Maker::insert([
        	['name' => 'Honda', 'picture' => 'honda.png'],
        	['name' => 'Suzuki', 'picture' => 'suzuki.png'],
        	['name' => 'Daihatsu', 'picture' => 'daihatsu.png'],
        ]);
    }
}
