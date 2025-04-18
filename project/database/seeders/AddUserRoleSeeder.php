<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AddUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
   
        // DB::table('users')->insert([
        //     [
        //         'name' => 'Admin User',
        //         'email' => 'admin@gmail.com',
        //         'password' => Hash::make('123456789'),
        //         'role_id' => 1,
        //     ],
        //     [
        //         'name' => 'Formateur',
        //         'email' => 'formateur@gmail.com',
        //         'password' => Hash::make('123'),
        //         'role_id' => 2,
        //     ]
        // ]);

      
        $faker = Faker::create();
        $users = [];

        for ($i = 1; $i <= 2; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role_id' => $faker->randomElement([1, 2, 3]), 
            ];
        }

        DB::table('users')->insert($users);
    }
}
