<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Etudiant;
use App\Models\Cours;
use App\Models\Inscription;

class InscriptionSeeder extends Seeder
{
    public function run(): void
    {
        $etudiants = Etudiant::all();
        $cours = Cours::all();

      
        foreach ($cours as $coursItem) {
            $etudiant = $etudiants->random(); 
            Inscription::firstOrCreate([
                'etudiant_id' => $etudiant->id,
                'cours_id' => $coursItem->id,
                'status' => 'accepted',
            ]);
        }

     
        foreach ($etudiants as $etudiant) {
            $coursIds = $cours->pluck('id')->toArray();

          
            $coursDejaInscrit = Inscription::where('etudiant_id', $etudiant->id)->pluck('cours_id')->toArray();
            $coursRestants = array_diff($coursIds, $coursDejaInscrit);

            $nombreCours = rand(1, 12 - count($coursDejaInscrit));
            $coursChoisis = collect($coursRestants)->random(min($nombreCours, count($coursRestants)));

            foreach ($coursChoisis as $coursId) {
                Inscription::firstOrCreate([
                    'etudiant_id' => $etudiant->id,
                    'cours_id' => $coursId,
                    'status' => 'accepted',
                ]);
            }
        }
    }
}
