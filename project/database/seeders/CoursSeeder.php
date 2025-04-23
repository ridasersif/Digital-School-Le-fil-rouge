<?php
namespace Database\Seeders;
use App\Models\Cours;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CoursSeeder extends Seeder
{
    public function run(): void
    {
        $images = collect(Storage::files('public/cours_images'));
        $videos = collect(Storage::files('public/cours_videos'));
       

        for ($i = 1; $i <= 100; $i++) {
            Cours::create([
                'titre' => 'Cours ' . $i,
                'description' => 'Description du cours ' . $i,
                'image' => 'cours_images/' . basename($images->random()),
                'video_intro' => 'cours_videos/' . basename($videos->random()),
                'status' => 'published',
                'formateur_id' => rand(1, 10),
                'category_id' => rand(1, 10),
                'price' => rand(100, 1000),
                'old_price' => rand(1000, 1500),
            ]);
        }
    }
}
