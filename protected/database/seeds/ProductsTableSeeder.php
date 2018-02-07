<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Product::insert([
    		['name' => 'N-BOX', 'maker_id' => 1, 'picture' => 'nbox.jpg'],
    	]);

        Product::insert([
        	['name' => 'Alto', 'maker_id' => 2, 'picture' => 'alto.jpg'],
        	['name' => 'Hustler Orange', 'maker_id' => 2, 'picture' => 'hustler-1.jpg'],
        	['name' => 'Hustler Red', 'maker_id' => 2, 'picture' => 'hustler-2.jpg'],
        	['name' => 'Lapin', 'maker_id' => 2, 'picture' => 'lapin.jpg'],
        	['name' => 'Spacia', 'maker_id' => 2, 'picture' => 'spacia.jpg'],
        	['name' => 'Swift', 'maker_id' => 2, 'picture' => 'swift.jpg'],
        	['name' => 'Wagon-R', 'maker_id' => 2, 'picture' => 'wagon-r.jpg'],
        ]);

        Product::insert([
        	['name' => 'Tanto White', 'maker_id' => 3, 'picture' => 'tanto-white.jpg'],
        	['name' => 'Tanto 1', 'maker_id' => 3, 'picture' => 'tanto-1.jpg'],
        ]);
    }
}
