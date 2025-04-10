<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Http\Requests\StoreCoursRequest;
use App\Http\Requests\UpdateCoursRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
    $user = Auth::user();
    $formateur = $user->formateur;
    $courses = $formateur ? $formateur->cours()->withCount('contents')->orderBy('created_at', 'desc')->paginate(100) : collect();

    return view('instructor.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $isUpdate=false;
        $categories = Category::all(); 
        return view('instructor.courses.create',compact('categories','isUpdate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoursRequest $request)
    {
        $videoPath = null;
        if ($request->hasFile('video_intro')) {
            $videoPath = $request->file('video_intro')->store('cours/videos', 'public');
        }
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cours/images', 'public');
        }
        
   
        Cours::create([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            
            'price' => $request->input('price'),
            'video_intro' => $videoPath,
            'image' => $imagePath,
            'formateur_id' => $request->input('formateur_id'),
        ]);

        
        return redirect()->route('instructor.course.index')->with('success', 'Le cours a été enregistré dans la base de données, mais il est encore vide. Vous pouvez ajouter du contenu plus tard.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Cours $course)
    {
        // Vérifier que l'utilisateur connecté est bien le formateur de ce cours
        $user = Auth::user();
        $formateur = $user->formateur;
        
        if ($formateur && $formateur->id === $course->formateur_id) {
            return view('instructor.courses.show', compact('course'));
        }
        
        // Rediriger si l'utilisateur n'est pas autorisé
        return redirect()->route('instructor.courses.index')
            ->with('error', 'Vous n\'êtes pas autorisé à voir ce cours.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cours $course)
    {
        $isUpdate=true;
        $categories = Category::all(); 
        return view('instructor.courses.create',compact('course','categories','isUpdate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoursRequest $request, Cours $course)
    {
       
        $videoPath = $course->video_intro;  
        if ($request->hasFile('video_intro')) {
            if ($videoPath) {
                Storage::disk('public')->delete($videoPath);
            }
            $videoPath = $request->file('video_intro')->store('cours/videos', 'public');
        }
        $imagePath = $course->image;  
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('cours/images', 'public');
        }
        $course->update([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'video_intro' => $videoPath,
            'image' => $imagePath,
        ]);
    
        // Redirect back with a success message
        return redirect()->route('instructor.course.index')->with('success', 'Le cours a été mis à jour avec succès.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cours $course)
    {
        if ($course->video_intro) {
            Storage::disk('public')->delete($course->video_intro);
        }
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        $course->delete();
        return redirect()->route('instructor.course.index')->with('success', 'Le cours a été supprimé avec succès.');
    }
    
}
