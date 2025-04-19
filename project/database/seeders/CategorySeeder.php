<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'nom' => 'Développement Web',
                'icon' => 'mdi:code-tags',
                'description' => 'Apprendre à créer des sites et applications web.',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Design Graphique',
                'icon' => 'mdi:palette',
                'description' => 'Tout sur le design et la création visuelle.',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Intelligence Artificielle',
                'icon' => 'mdi:robot',
                'description' => 'Explorer les bases et avancées de l’IA.',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Data Science',
                'icon' => 'mdi:chart-bar',
                'description' => 'Analyse de données, statistiques et plus.',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Cybersécurité',
                'icon' => 'mdi:shield-lock',
                'description' => 'Protéger les systèmes et réseaux.',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Réseaux Informatiques',
                'icon' => 'mdi:access-point-network',
                'description' => 'Comprendre le fonctionnement des réseaux.',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Marketing Digital',
                'icon' => 'mdi:bullhorn',
                'description' => 'Apprendre à promouvoir sur le web.',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Cloud Computing',
                'icon' => 'mdi:cloud-outline',
                'description' => 'Travailler avec AWS, Azure, Google Cloud...',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Développement Mobile',
                'icon' => 'mdi:cellphone',
                'description' => 'Créer des applications pour Android & iOS.',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Gestion de Projet',
                'icon' => 'mdi:clipboard-text',
                'description' => 'Scrum, Agile, et la gestion d’équipe.',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
