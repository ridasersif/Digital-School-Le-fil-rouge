<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getAllCoursPublished(){
        $cours = Cours::where('status', 'published')
        ->with(['category', 'formateur.user.profile'])
        ->withCount('contents')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('frontend.home',compact('cours'));
    }
    public function show($id)
    {
        $course = Cours::with(['category', 'formateur.user.profile'])->withCount('contents')->findOrFail($id);
        // dd($course);
        return view('user.courses.show', compact('course'));
    }

}
