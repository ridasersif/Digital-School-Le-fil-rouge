<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Category;
use App\Models\Cours;
use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHomePageData()
    {
        $cours = Cours::where('status', 'published')
        ->with(['category', 'formateur.user.profile'])
        ->withCount('contents')
        ->withCount('avis') 
        ->withAvg('avis', 'note') 
        ->orderBy('created_at', 'desc')
        ->inRandomOrder()
        ->take(4)
        ->get();

        $totalCours = Cours::where('status', 'published')->count();
        $totalEtudiants = Etudiant::get()->count();

        $categories = Category::withCount(['cours' => function ($query) {
                $query->where('status', 'published');
            }])
            ->whereHas('cours', function ($query) {
                $query->where('status', 'published');
            })
            ->orderByDesc('cours_count')
            ->inRandomOrder()
            ->take(6)
            ->get();

            $avis = Avis::with(['cours.formateur.user.profile', 'etudiant.user.profile'])
            ->latest()
            ->inRandomOrder()
            ->take(3)
            ->get();
       
        return view('frontend.home', compact('cours', 'categories', 'avis', 'totalCours','totalEtudiants'));
    }
    
    
    

    public function show($id)
    {
        $course = Cours::with(['category', 'formateur.user.profile'])->withCount('contents')->findOrFail($id);
       
        return view('user.courses.show', compact('course'));
    }
    public function getAllCourses()
    {
        $cours = Cours::where('status', 'published')
        ->with(['category', 'formateur.user.profile'])
        ->withCount('contents')
        ->withCount('avis') 
        ->withAvg('avis', 'note') 
        ->orderBy('created_at', 'desc')
        ->inRandomOrder()
        ->paginate(8);
      
    
        return view('frontend.allCourses', compact('cours'));
    }
    public function getAllCategories()
    {
        $categories = Category::withCount(['cours' => function ($query) {
                $query->where('status', 'published');
            }])
            ->whereHas('cours', function ($query) {
                $query->where('status', 'published');
            })
            ->orderByDesc('cours_count')
            ->get();
    
        return view('frontend.categories', compact('categories'));
    }

}