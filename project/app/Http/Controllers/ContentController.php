<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Models\Cours;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('instructor.courses.contents.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($cours_id)
    {
        $course = Cours::findOrFail($cours_id);
        return view('instructor.courses.contents.create',compact('course')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContentRequest $request)
    {
        $type = $request->type;
        $contentPath = null;
        $duree = null;
        // dd($request->all());
        if ($type === 'video') {
            $duree = $request->input('duree_video');
            if ($request->hasFile('chemin_video')) {
                $contentPath = $request->file('chemin_video')->store('content/videos', 'public');
            }
        } elseif ($type === 'pdf') {
            if ($request->hasFile('chemin_pdf')) {
                $contentPath = $request->file('chemin_pdf')->store('content/pdf', 'public');
            }
        } else {
            $duree = $request->input('duree_lien');
            $contentPath = $request->input('chemin_lien');
            if (!preg_match('/^https?:\/\//', $contentPath)) {
                $contentPath = 'https://' . $contentPath;
            }
        }
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('content/images', 'public');
        }
    
       
        Content::create([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'type' => $type, 
            'chemin' => $contentPath, 
            'image' => $imagePath,
            'duree' => $duree,
            'nombre_pages' => $type === 'pdf' ? $request->input('nombre_pages_pdf') : null,
            'cours_id' => $request->input('cours_id'),
        ]);
        return redirect()
            ->route('course.show', ['course' => $request->input('cours_id')])
            ->with('success', 'Contenu ajouté avec succès.');
    }
    
    

    /**
     * Display the specified resource.
     */
  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
      
        return view('instructor.courses.contents.edit', compact('content')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContentRequest $request, Content $content)
    {
       
        if (Auth::user()->formateur->id !== $content->cours->formateur_id) {
             abort(403, 'Unauthorized action.');
        }
        $type = $request->type;
        $contentPath = null;
        $duree = null;
    
        if ($type === 'video') {
            $duree = $request->input('duree_video');
           
            if ($request->hasFile('chemin_video')) {
              
                if ($content->chemin && file_exists(storage_path('app/public/' . $content->chemin))) {
                    unlink(storage_path('app/public/' . $content->chemin));
                }
             
                $contentPath = $request->file('chemin_video')->store('content/videos', 'public');
            } else {
              
                $contentPath = $content->chemin;
            }
        }
       
        elseif ($type === 'pdf') {
           
            if ($request->hasFile('chemin_pdf')) {
                
                if ($content->chemin && file_exists(storage_path('app/public/' . $content->chemin))) {
                    unlink(storage_path('app/public/' . $content->chemin));
                }
               
                $contentPath = $request->file('chemin_pdf')->store('content/pdf', 'public');
            } else {
               
                $contentPath = $content->chemin;
            }
        }
      
        else {
            $duree = $request->input('duree_lien');
            $contentPath = $request->input('chemin_lien');
            if (!preg_match('/^https?:\/\//', $contentPath)) {
                $contentPath = 'https://' . $contentPath;
            }
        }
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            if ($content->image && file_exists(storage_path('app/public/' . $content->image))) {
                unlink(storage_path('app/public/' . $content->image));
            }
            $imagePath = $request->file('image')->store('content/images', 'public');
        } else {
            $imagePath = $content->image;
        }

        $content->update([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'type' => $type, 
            'chemin' => $contentPath, 
            'image' => $imagePath,
            'duree' => $duree,
            'nombre_pages' => $type === 'pdf' ? $request->input('nombre_pages_pdf') : null,
            'cours_id' => $request->input('cours_id'),
        ]);
    
        return redirect()
            ->route('course.show', ['course' => $request->input('cours_id')])
            ->with('success', 'Contenu mis à jour avec succès.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        if (Auth::user()->formateur->id !== $content->cours->formateur_id) {
            abort(403, 'Unauthorized action.');
        }
   
        $courseId = $content->cours_id;
        if ($content->chemin){
            Storage::disk('public')->delete($content->chemin);
        }
        if ($content->image) {
            Storage::disk('public')->delete($content->image);
        }
        $content->delete();
        return redirect()
        ->route('course.show', ['course' => $courseId])
        ->with('success', 'Contenu supprimé avec succès.');
    }


public function markAsViewed($id, Request $request)
{
    $user = Auth::user();


    if (!$user->etudiant) {
        return response()->json(['message' => 'Non autorisé'], 403);
    }

    $etudiant = $user->etudiant;
    $content = Content::findOrFail($id);

   
    $alreadyViewed = $etudiant->contents()->where('content_id', $id)->exists();

    if (!$alreadyViewed) {
        $etudiant->contents()->attach($content->id, ['viewed_at' => now()]);
    }

    return response()->json(['message' => '✅ Le contenu a été marqué comme lu']);
}

}
