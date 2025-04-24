<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Formateur;
use App\Models\Etudiant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class AddUserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'role_id' => 1,
        ]);
        $this->createProfile($admin->id, $faker);

        for ($i = 1; $i <= 10; $i++) {
            $formateur = User::create([
                'name' => 'Formateur ' . $i,
                'email' => 'formateur' . $i . '@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => 2,
            ]);
            $this->createProfile($formateur->id, $faker);

          
            Formateur::create([
                'user_id' => $formateur->id,
               
            ]);
        }
        for ($i = 1; $i <= 100; $i++) {
            $etudiant = User::create([
                'name' => 'Etudiant ' . $i,
                'email' => 'etudiant' . $i . '@gmail.com',
                'password' => Hash::make('123456789'),
                'role_id' => 3,
            ]);
            $this->createProfile($etudiant->id, $faker);

          
            Etudiant::create([
                'user_id' => $etudiant->id,
               
            ]);
        }
    }

    private function createProfile($userId, $faker)
    {
        $avatar = collect(Storage::files('public/avatars'));
        Profile::create([
            'user_id' => $userId,
            'phone' => $faker->phoneNumber,
            'address' => $faker->address,
            'bio' => $faker->sentence(10),
            'avatar' => 'avatars/' . basename($avatar->random()),
        ]);
    }
}
