<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Cours;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

       
        $images = collect(Storage::files('public/cours_images'));
        $videos = collect(Storage::files('public/cours_videos'));
        $pdf = collect(Storage::files('public/cours_pdf'));


       
        $types = ['video', 'pdf', 'link'];

      
        $coursList = Cours::all();

        foreach ($coursList as $cours) {
            for ($i = 1; $i <= 20; $i++) {
                $type = $types[array_rand($types)];
                $chemin = null;
                $duree = null;
                $nombrePages = null;

                if ($type === 'video') {
                    $chemin = 'cours_videos/' . basename($videos->random());
                    $duree = $faker->numberBetween(5, 120); 
                } elseif ($type === 'pdf') {
                    $chemin = 'cours_pdf/' . basename($pdf->random());
                    $nombrePages = $faker->numberBetween(10, 100);
                } else {
                    $chemin = $faker->url();
                    $duree = $faker->numberBetween(1, 120);
                }

               
                $imagePath = 'cours_images/' . basename($images->random());

                
                Content::create([
                    'titre' => 'Contenu ' . $i . ' du cours ' . $cours->id,
                    'description' => $faker->sentence(12),
                    'type' => $type,
                    'chemin' => $chemin,
                    'image' => $imagePath,
                    'duree' => $duree,
                    'nombre_pages' => $nombrePages,
                    'cours_id' => $cours->id,
                ]);
            }
        }
    }
}
