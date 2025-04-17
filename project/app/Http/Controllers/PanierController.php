<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cours;
use Illuminate\Support\Facades\Auth;

class PanierController extends Controller
{
    public function ajouter(Cours $cours)
    {
        $user = Auth::user();
    
        $etudiant = $user->etudiant;
    
        if (!$etudiant) {
            return redirect()->back()->with('error', 'Profil étudiant non trouvé.');
        }
    
        if ($etudiant->panier()->where('cours_id', $cours->id)->exists()) {
            return redirect()->back()->with('info', 'Ce cours est déjà dans votre panier.');
        }
        $inscriptionExist = \App\Models\Inscription::where('etudiant_id', $etudiant->id)
        ->where('cours_id', $cours->id)
        ->exists();

        if ($inscriptionExist) {
        return redirect()->back()->with('info', 'Vous êtes déjà inscrit à ce cours.');
        }
    
        $etudiant->panier()->attach($cours->id);
    
        return redirect()->back()->with('success', 'Cours ajouté au panier avec succès.');
    }

    
    public function afficherPanier()
    {
        $user = Auth::user();
        $etudiant = $user->etudiant;

        if (!$etudiant) {
            return redirect()->back()->with('error', 'Profil étudiant non trouvé.');
        }

        $cours = $etudiant->panier()
            ->with(['formateur.user.profile', 'category', 'contents']) 
            ->withCount('contents')
            ->paginate(2);

        
        $cours->getCollection()->transform(function ($course) {
            $course->filtered_contents = $course->contents->map(function ($content) {
                return [
                    'type' => $content->type,
                    'duree' => $content->duree,
                    'nombre_pages' => $content->nombre_pages,
                ];
            });

            return $course;
        });

        return view('student.courses.panier', compact('cours'));
    }
    public function delete(Cours $cours)
{
    $user = Auth::user();


    $etudiant = $user->etudiant;

    if (!$etudiant) {
        return redirect()->back()->with('error', 'Profil étudiant non trouvé.');
    }

    // Vérifier si le cours existe dans le panier
    if (!$etudiant->panier()->where('cours_id', $cours->id)->exists()) {
        return redirect()->back()->with('info', 'Ce cours n\'est pas dans votre panier.');
    }

    $etudiant->panier()->detach($cours->id); 

    return redirect()->back()->with('success', 'Cours supprimé du panier avec succès.');
}
public function vider()
{
    $user = Auth::user();
    $etudiant = $user->etudiant;

    if (!$etudiant) {
        return redirect()->back()->with('error', 'Profil étudiant non trouvé.');
    }

    $etudiant->panier()->detach(); 

    return redirect()->back()->with('success', 'Votre panier a été vidé avec succès.');
}



    
}
