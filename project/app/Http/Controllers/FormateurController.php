<?php

namespace App\Http\Controllers;

use App\Models\Formateur;
use App\Http\Requests\StoreFormateurRequest;
use App\Http\Requests\UpdateFormateurRequest;
use Illuminate\Support\Facades\Auth;

class FormateurController extends Controller
{
    public function mesAvis(){
        $formateur = Formateur::where('user_id', Auth::id())->first();
        if (!$formateur) {
            return back()->with('error', 'Formateur non trouvé.');
        }
        $coursAvecAvis = $formateur->cours()->with(['avis.etudiant.user.profile'])->get();
      
        return view('instructor.avis.index', compact('coursAvecAvis'));
    }
   
}
