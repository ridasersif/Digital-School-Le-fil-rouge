<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Http\Requests\StoreCoursRequest;
use App\Http\Requests\UpdateCoursRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($status)
    {
         $user = Auth::user();
        if($user->role_id == 2){
            $formateur = $user->formateur;
            if($status == 'all'){
                $courses = $formateur ? $formateur->cours()->withCount('contents')->orderBy('created_at', 'desc')->paginate(100) : collect();
            
            }else if($status == 'draft'){
            $courses = $formateur ? $formateur->cours()->where('status','draft')->withCount('contents')->orderBy('created_at', 'desc')->paginate(100) : collect();
    
            }else if($status == 'pending'){
                $courses = $formateur ? $formateur->cours()->where('status','pending')->withCount('contents')->orderBy('created_at', 'desc')->paginate(100) : collect();
            }else{
                $courses = $formateur ? $formateur->cours()->where('status','published')->withCount('contents')->orderBy('created_at', 'desc')->paginate(100) : collect();
            }
            return view('instructor.courses.index', compact('courses'));
        }
        if($user->role_id == 1){
            if($status == 'all'){
                $courses = Cours::where('status', '!=', 'draft')->with(['contents', 'formateur.user.profile'])->withCount('contents')->orderBy('created_at', 'desc')->paginate(100);
                // dd($courses);
            }else if($status == 'pending'){
                $courses = Cours::where('status','pending')->withCount('contents')->orderBy('created_at', 'desc')->paginate(100);
            }else if($status == 'published'){
                $courses = Cours::where('status','published')->withCount('contents')->orderBy('created_at', 'desc')->paginate(100);    
           }
            return view('admin.courses.index', compact('courses'));

        } 
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

        
        return redirect()->route('course.index')->with('success', 'Le cours a été enregistré dans la base de données, mais il est encore vide. Vous pouvez ajouter du contenu plus tard.');

    }
   
    /**
     * Display the specified resource.
     */
    public function show(Cours $course)
    {
         // Vérifier que l'utilisateur connecté est bien le formateur de ce cours
         $user = Auth::user();
        if($user->role_id == 2){
            $formateur = $user->formateur;
        
            if ($formateur && $formateur->id === $course->formateur_id) {
                $course->load('contents');
                // dd($course);
                return view('instructor.courses.show', compact('course'));
            }
            // Rediriger si l'utilisateur n'est pas autorisé
            return redirect()->route('instructor.courses.index')
                ->with('error', 'Vous n\'êtes pas autorisé à voir ce cours.');
          
        }
        if($user->role_id == 1){
            $course->load(['contents', 'formateur.user.profile', 'category']);
            return view('admin.courses.show', compact('course'));
           

        } 
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
        return redirect()->route('course.index')->with('success', 'Le cours a été mis à jour avec succès.');
    }

    public function updateStatus($id)
    {
        $course = Cours::findOrFail($id);
        if(Auth::user()->role_id == 2){
             // Vérifie le statut actuel et le change en conséquence
            if ($course->status === 'draft') {
                $course->status = 'pending';
            } elseif ($course->status === 'pending') {
                $course->status = 'draft';
            }
        }
        // $table->enum('status', ['draft', 'pending', 'published'])->default('draft');

        if(Auth::user()->role_id == 1){
             // Vérifie le statut actuel et le change en conséquence
            if ($course->status === 'pending') {
                $course->status = 'published';
            } elseif ($course->status === 'published') {
                $course->status = 'pending';
            }
        }
       
        $course->save();
    
        return redirect()->back()->with('success', 'Le statut du cours a été mis à jour.');
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
        return redirect()->route('course.index')->with('success', 'Le cours a été supprimé avec succès.');
    }
    
}
