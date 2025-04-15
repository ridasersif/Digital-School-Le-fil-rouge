<?php 
// app/Interfaces/CoursInterface.php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CoursInterface
{
    public function getCoursesByStatusForUser($status);
    public function storeCourse(Request $request);
    public function showCourse($course);
    public function updateCourse(Request $request, $course);
    public function deleteCourse($course);
    public function updateCourseStatus($id);
}
