<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cours;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getAllCoursPublished()
    {
        $cours = Cours::where('status', 'published')
            ->with(['category', 'formateur.user.profile'])
            ->withCount('contents')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
    
        $categories = Category::withCount(['cours' => function ($query) {
                $query->where('status', 'published');
            }])
            ->whereHas('cours', function ($query) {
                $query->where('status', 'published');
            })
            ->orderByDesc('cours_count')
            ->take(6)
            ->get();
    
        return view('frontend.home', compact('cours', 'categories'));
    }
    

    public function show($id)
    {
        $course = Cours::with(['category', 'formateur.user.profile'])->withCount('contents')->findOrFail($id);
        // dd($course);
        return view('user.courses.show', compact('course'));
    }
    public function getAllCourses()
    {
        $cours = Cours::where('status', 'published')
            ->with(['category', 'formateur.user.profile'])
            ->withCount('contents')
            ->orderBy('created_at', 'desc')
            ->paginate(6);
    
        return view('frontend.allCourses', compact('cours'));
    }
   
}
