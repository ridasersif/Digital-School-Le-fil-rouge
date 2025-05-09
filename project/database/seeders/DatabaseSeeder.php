<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        $this->call(RolesSeeder::class);
        $this->call(AddUserRoleSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CoursSeeder::class);
        $this->call(ContentSeeder::class);
        $this->call(InscriptionSeeder::class);
        $this->call(AvisSeeder::class);
        $this->call(PaymentSeeder::class);
    }
}
