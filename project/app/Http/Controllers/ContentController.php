<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Models\Cours;
use Illuminate\Support\Facades\Storage;

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
            ->route('instructor.course.show', ['course' => $request->input('cours_id')])
            ->with('success', 'Contenu ajouté avec succès.');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(Content $content)
    {
        
    }

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content)
    {
        $courseId = $content->cours_id;
        if ($content->chemin){
            Storage::disk('public')->delete($content->chemin);
        }
        if ($content->image) {
            Storage::disk('public')->delete($content->image);
        }
        $content->delete();
        return redirect()
        ->route('instructor.course.show', ['course' => $courseId])
        ->with('success', 'Contenu supprimé avec succès.');
    }
}
