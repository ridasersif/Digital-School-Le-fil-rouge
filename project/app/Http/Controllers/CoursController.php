<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Http\Requests\StoreCoursRequest;
use App\Http\Requests\UpdateCoursRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Interfaces\CoursInterface;

class CoursController extends Controller
{
    protected $coursRepository;

    public function __construct(CoursInterface $coursRepository)
    {
        $this->coursRepository = $coursRepository;
    }

    public function index($status)
    {
        $courses = $this->coursRepository->getCoursesByStatusForUser($status);
        $view = Auth::user()->role_id == 2 ? 'instructor.courses.index' : 'admin.courses.index';
        return view($view, compact('courses'));
    }

    public function create()
    {
        $isUpdate = false;
        $categories = Category::all();
        return view('instructor.courses.create', compact('categories', 'isUpdate'));
    }

    public function store(StoreCoursRequest $request)
    {
        $this->coursRepository->storeCourse($request);
        return redirect()->route('course.index')->with('success', 'Le cours a été enregistré...');
    }

    public function show(Cours $course)
    {
        $course = $this->coursRepository->showCourse($course);
        if (!$course) {
            return redirect()->route('instructor.courses.index')->with('error', 'Non autorisé');
        }

        $view = Auth::user()->role_id == 2 ? 'instructor.courses.show' : 'admin.courses.show';
        return view($view, compact('course'));
    }

    public function edit(Cours $course)
    {
        $isUpdate = true;
        $categories = Category::all();
        return view('instructor.courses.create', compact('course', 'categories', 'isUpdate'));
    }

    public function update(UpdateCoursRequest $request, Cours $course)
    {
        $this->coursRepository->updateCourse($request, $course);
        return redirect()->route('course.index')->with('success', 'Le cours a été mis à jour...');
    }

    public function updateStatus($id)
    {
        $this->coursRepository->updateCourseStatus($id);
        return redirect()->back()->with('success', 'Le statut du cours a été mis à jour.');
    }

    public function destroy(Cours $course)
    {
        $this->coursRepository->deleteCourse($course);
        return redirect()->route('course.index')->with('success', 'Le cours a été supprimé.');
    }
}
