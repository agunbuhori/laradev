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
        $user = new User;
        
        $user->name = "Agun Buhori";
        $user->email = "agun@buhori.com";
        $user->password = bcrypt("secret");

        $user->save();
    }
}
