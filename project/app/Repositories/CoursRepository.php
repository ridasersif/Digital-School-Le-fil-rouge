<?php 
// app/Repositories/CoursRepository.php

namespace App\Repositories;

use App\Models\Cours;
use App\Models\Category;
use App\Interfaces\CoursInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CoursRepository implements CoursInterface
{
    public function getCoursesByStatusForUser($status)
    {
        $user = Auth::user();
    
        if ($user->role_id == 2) {
            $formateur = $user->formateur;
    
            return $formateur ? $formateur->cours()
                ->when($status !== 'all', fn($query) => $query->where('status', $status))
                ->withCount('contents')
                ->orderBy('created_at', 'desc')
                ->paginate(100) : collect();
        }
    
        if ($user->role_id == 1) {
            return Cours::when(true, function ($query) use ($status) {
                      
                        $query->where('status', '!=', 'draft');
    
                        if ($status !== 'all') {
                            $query->where('status', $status);
                        }
                    })
                    ->with(['contents', 'formateur.user.profile'])
                    ->withCount('contents')
                    ->orderBy('created_at', 'desc')
                    ->paginate(100);
        }
    
        return collect();
    }
    


    public function storeCourse(Request $request)
    {
      
        $videoPath = $request->hasFile('video_intro')
            ? $request->file('video_intro')->store('cours/videos', 'public')
            : null;

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('cours/images', 'public')
            : null;
        // dd($request->all());
        return Cours::create([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'old_price' => $request->input('old_price'),
            'video_intro' => $videoPath,
            'image' => $imagePath,
            'formateur_id' => $request->input('formateur_id'),
        ]);
    }

    public function showCourse($course)
    {
        $user = Auth::user();

        if ($user->role_id == 2 && $user->formateur->id === $course->formateur_id) {
            return $course->load('contents');
        }

        if ($user->role_id == 1) {
            return $course->load(['contents', 'formateur.user.profile', 'category']);
        }

        return null;
    }

    public function updateCourse(Request $request, $course)
    {
        $videoPath = $course->video_intro;
        if ($request->hasFile('video_intro')) {
            if ($videoPath) Storage::disk('public')->delete($videoPath);
            $videoPath = $request->file('video_intro')->store('cours/videos', 'public');
        }

        $imagePath = $course->image;
        if ($request->hasFile('image')) {
            if ($imagePath) Storage::disk('public')->delete($imagePath);
            $imagePath = $request->file('image')->store('cours/images', 'public');
        }

        $course->update([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'old_price' => $request->input('old_price'),
            'video_intro' => $videoPath,
            'image' => $imagePath,
        ]);

        return $course;
    }

    public function deleteCourse($course)
    {
        if ($course->video_intro) Storage::disk('public')->delete($course->video_intro);
        if ($course->image) Storage::disk('public')->delete($course->image);

        $course->delete();
    }

    public function updateCourseStatus($id)
    {
        $course = Cours::findOrFail($id);
        $user = Auth::user();

        if ($user->role_id == 2) {
            $course->status = $course->status === 'draft' ? 'pending' : 'draft';
        } elseif ($user->role_id == 1) {
            $course->status = $course->status === 'pending' ? 'published' : 'pending';
        }

        $course->save();
        return $course;
    }
   
}
