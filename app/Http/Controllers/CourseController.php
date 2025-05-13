<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;

class CourseController extends Controller
{

    public function create()
    {
        //
    }

    public function store(CourseStoreRequest $request)
    {
        $this->authorize('create', Course::class);

        $course = Course::create($request->validated());

        return redirect()->route('courses.show', $course);
    }

    public function show(string $level, int $course)
    {        
        $course = Course::where('course_level', $level)->where('id', $course)->firstOrFail();
        $this->authorize('view', $course);
        
        return view('courses.show', compact('course'));
    }

    public function showLevel(string $level)
    {
        if(!in_array($level, ['level_0', 'level_1', 'level_2', 'level_3', 'level_4'])) {
            abort(404);
        }

        if(auth()->user()->isAdmin()) {
            $courses = Course::where('course_level', $level)->get();
        }else{
            $courses = auth()->user()->courses->where('course_level', $level);
        }
        
        return view('showLevel', compact('courses'));
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
