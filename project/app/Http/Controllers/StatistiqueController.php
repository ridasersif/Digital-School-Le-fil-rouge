<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cours;
use App\Models\Etudiant;
use App\Models\Formateur;
use App\Models\Inscription;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatistiqueController extends Controller
{
    public function statistiqueForadmin()
    {
        $totalUsers = User::count();
        $totalCours = Cours::count();
        $totalCategories = Category::count();
        $totalRevenue = Payment::sum('amount');
        // dd($totalRevenue,$totalUsers, $totalCours, $totalCategories);
        return view('admin.statistics', compact('totalUsers', 'totalCours', 'totalCategories', 'totalRevenue'));
    }

    public function statistiqueForInstructor()
    {
      
        $formateur = Auth::user();

       
        $coursCount = Cours::where('formateur_id', $formateur->id)->count();

       
        
        $studentsCount = Inscription::
        whereIn('cours_id', Cours::
        where('formateur_id', $formateur->id)
        ->pluck('id'))
         ->distinct('etudiant_id')
         ->count('etudiant_id');


        
     
         $revenue = Payment::
         whereIn('inscription_id', function($query) use ($formateur) {
          $query->select('id')
           ->from('inscriptions')
           ->whereIn('cours_id', Cours::
           where('formateur_id', $formateur->id)
           ->pluck('id'));
            })->sum('amount');
                                        
       
        return view('instructor.statistics', compact(
            'coursCount',
            'studentsCount',
            'revenue'
        ));
    }
}
