<?php

use App\Mall;
use Illuminate\Database\Seeder;

class MallsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mall::insert([
        	[
                'code' => '23PASKAL', 
                'picture' => '23paskal.png', 
                'name' => '23 Paskal Mall Shopping Center', 
                'latitude' => '-6.9154574', 
                'longitude' => '107.5926572', 
                'address' => 'Paskal Hypersquare Complex Jl. Pasir Kaliki No.25-27 Bandung, Jawa Barat',
                'user_id' => 1
            ],
        	[
                'code' => 'FX-SUDIRMAN', 
                'picture' => 'fxsudirman.png', 
                'name' => 'FX Sudirman', 
                'latitude' => '-6.2245751', 
                'longitude' => '106.8018294', 
                'address' => 'Jalan Jenderal Sudirman, Pintu Satu Senayan, Senayan, Gelora, Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10270',
                'user_id' => 1
            ],
        ]);
    }
}
