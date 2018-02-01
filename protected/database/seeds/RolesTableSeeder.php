<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
        	['name' => 'superadmin'],
        	['name' => 'mall'],
        	['name' => 'merchant'],
        	['name' => 'parking'],
        	['name' => 'user'],
        ]);
    }
}
