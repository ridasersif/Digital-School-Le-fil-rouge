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
   
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => 1,
            ],
            [
                'name' => 'Formateur',
                'email' => 'formateur@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => 2,
            ],
            [
                'name' => 'Etudiant',
                'email' => 'etudiant@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => 3,
            ]
        ]);

      
    }
}
