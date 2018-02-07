<?php

use App\Vehicle;
use Illuminate\Database\Seeder;

class VehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$region = "ABDEZTRF";
    	$alphas = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        for ($x = 0; $x < 10; $x++) {
        	for ($y = 0; $y < rand(10, 40); $y++) {
        		$plate = $region[rand(0, 7)];
        		$number = rand(1111, 9999);
        		$alpha = "";
        		foreach (range(0, 2) as $num) {
        			$alpha .= $alphas[rand(0, 25)];
        		}

        		$full = $plate." ".$number." ".$alpha;
        		Vehicle::insert(['picture' => 'car.svg', 'number' => $full, 'color' => '#ffffff', 'status' => 0, 'product_id' => $x+1]);
        	}
        }
    }
}
