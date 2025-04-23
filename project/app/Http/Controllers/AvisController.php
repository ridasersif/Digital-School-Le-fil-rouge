<?php
// app/Http/Controllers/AvisController.php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function store(Request $request, $coursId)
    {
 
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:1000',
        ]);

        $etudiant = Etudiant::where('user_id', Auth::id())->first();

        
        if (!$etudiant->cours()->where('cours_id', $coursId)->exists()) {
            return back()->with('error', 'Vous devez être inscrit à ce cours.');
        }

      
        if (Avis::where('etudiant_id', $etudiant->id)->where('cours_id', $coursId)->exists()) {
            return back()->with('error', 'Vous avez déjà laissé un avis pour ce cours.');
        }

        Avis::create([
            'etudiant_id' => $etudiant->id,
            'cours_id' => $coursId,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
        ]);
        return back()->with('success', 'Merci pour votre avis !');
    }
    public function delete($id)
    {
        $avis = Avis::findOrFail($id);
        $avis->delete();

        return redirect()->back()->with('success', 'L\'avis a été supprimé avec succès.');
    }
    
}
