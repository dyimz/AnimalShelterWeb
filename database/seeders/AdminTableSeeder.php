<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
       	$user->name = "admin";
       	$user->email = "admin@test.com";
        $user->password = bcrypt("password");
        $user->role = "admin";
        $user->save();

        $user = new User();
       	$user->name = "employee";
       	$user->email = "employee@test.com";
        $user->password = bcrypt("password");
        $user->role = "employee";
        $user->save();

        $user = new User();
       	$user->name = "rescuer";
       	$user->email = "rescuer@test.com";
        $user->password = bcrypt("password");
        $user->role = "rescuer";
        $user->save();

        $user = new User();
       	$user->name = "adopter";
       	$user->email = "adopter@test.com";
        $user->password = bcrypt("password");
        $user->role = "adopter";
        $user->save();
    }
}
