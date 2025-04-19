<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $student = Auth::user()->etudiant;

        $courses = $student->cours()->with('formateur.user.profile','contents','category') ->withCount('contents')->paginate(3);
             // dd($courses->toSql());
        return view('student.courses.mycours', compact('courses'));
    }
    public function show($id)
    {
        $course = Auth::user()->etudiant->cours()->with('formateur.user.profile','contents','category')->withCount('contents')->findOrFail($id);
        // dd($course);
        return view('student.courses.show', compact('course'));
    }

    

}
