<?php

namespace App\Http\Controllers;

use App\Models\Certificat;
use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CertificatController extends Controller
{
    public function download($coursId)
    {
        $etudiant = Auth::user()->etudiant;
        $cours = Cours::findOrFail($coursId);

        // 1. Vérifier si tous les contenus sont vus
        $totalContents = $cours->contents->count();
        $viewedContents = $etudiant->contents()->where('cours_id', $cours->id)->count();

        if ($totalContents == 0 || $viewedContents < $totalContents) {
            return back()->with('error', 'Vous devez d\'abord terminer tous les contenus.');
        }

        // 2. Vérifier si le certificat existe déjà
        $certificat = Certificat::where('etudiant_id', $etudiant->id)
            ->where('cours_id', $cours->id)
            ->first();

        // Si le certificat n'existe pas OU si le chemin est vide
        if (!$certificat || empty($certificat->certificat_path)) {
            // 3. Générer le PDF
            $pdf = Pdf::loadView('certificat.template', [
                'etudiant' => $etudiant,
                'cours' => $cours,
                'date' => now()->format('d/m/Y'),
                'formateur' => $cours->formateur,
                'totalContents' => $cours->contents->count(),
                'duree' => $cours->duree,
                'description' => $cours->description,
            ]);

            $fileName = 'certificat_' . $etudiant->id . '_' . $cours->id . '.pdf';
            $filePath = 'certificats/' . $fileName;

            // 4. Enregistrer le fichier dans le disque "public"
            Storage::disk('public')->put($filePath, $pdf->output());

            if (!$certificat) {
                // 5a. Créer un nouveau certificat
                $certificat = Certificat::create([
                    'etudiant_id' => $etudiant->id,
                    'cours_id' => $cours->id,
                    'generated_at' => now(),
                    'certificat_path' => $filePath,
                ]);
            } else {
                // 5b. Mettre à jour le certificat existant avec le nouveau chemin
                $certificat->certificat_path = $filePath;
                $certificat->generated_at = now();
                $certificat->save();
            }
        }

        // 6. Débogage pour s'assurer que le fichier existe
        if (!$certificat->certificat_path) {
            return back()->with('error', 'Le chemin du certificat est vide.');
        }

        if (!Storage::disk('public')->exists($certificat->certificat_path)) {
            // Si le fichier n'existe pas, régénérer le certificat
            $pdf = Pdf::loadView('certificat.template', [
                'etudiant' => $etudiant,
                'cours' => $cours,
                'date' => now()->format('d/m/Y'),
            ]);

            $fileName = 'certificat_' . $etudiant->id . '_' . $cours->id . '.pdf';
            $filePath = 'certificats/' . $fileName;
            
            Storage::disk('public')->put($filePath, $pdf->output());
            
            $certificat->certificat_path = $filePath;
            $certificat->generated_at = now();
            $certificat->save();
            
            return back()->with('info', 'Le certificat a été régénéré. Veuillez réessayer de le télécharger.');
        }
            /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
            $disk = Storage::disk('public');

            return $disk->download($certificat->certificat_path, 'Certificat' . $cours->titre . '.pdf');

    }
 
}