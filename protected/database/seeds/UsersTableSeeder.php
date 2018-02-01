<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$password = bcrypt('@secr3t_2017');

        User::insert([
        	['name' => 'Super Admin', 'email' => 'superadmin@spotme.com', 'password' => $password, 'role_id' => 1],
        	['name' => 'Mall', 'email' => 'mall@spotme.com', 'password' => $password, 'role_id' => 2],
        	['name' => 'Merchant', 'email' => 'merchant@spotme.com', 'password' => $password, 'role_id' => 3],
        	['name' => 'Parking', 'email' => 'parking@spotme.com', 'password' => $password, 'role_id' => 4],
        	['name' => 'Superadmin', 'email' => 'user@spotme.com', 'password' => $password, 'role_id' => 5],
        ]);
    }
}
