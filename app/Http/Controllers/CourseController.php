<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;

class CourseController extends Controller
{

    public function index()
    {
        $courses = Course::with('professors')->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        //
    }

    public function store(CourseStoreRequest $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function showLevel(int $level)
    {
        $courses = Course::where('course_level', $level)->get();
        return view('courses.showLevel', compact('courses'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(CourseUpdateRequest $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
