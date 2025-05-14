<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        
    }

    public function update(CourseUpdateRequest $request, string $level, int $id)
    {
        $course = Course::where('course_level', $level)->where('id', $id)->firstOrFail();
        
        $this->authorize('update', $course);

        $data = $request->validated();

        $data['exam_date'] = Carbon::parse($data['exam_date'])->format('d M');
        $data['exam_start_time'] = explode(':', $data['exam_start_time']);
        $data['exam_start_time'] = (int)$data['exam_start_time'][0] + (int)$data['exam_start_time'][1]/60;
        $data['exam_end_time'] = explode(':', $data['exam_end_time']);
        $data['exam_end_time'] = (int)$data['exam_end_time'][0] + (int)$data['exam_end_time'][1]/60;
        $data['duration'] = $data['exam_start_time'] . ':' . $data['exam_end_time'];
        unset($data['exam_start_time'], $data['exam_end_time']);
        
        foreach (['answer_papers_status', 'year_work_status', 'model_answers_status'] as $field) {
            $data[$field] = isset($data[$field]) && $data[$field] === 'on';
        }


        $course->update($data);

        return to_route('courses.show', ['level' => $level, 'course' => $id])->with(['status' => true, 'message' => 'Course updated successfully']);
    }

    public function destroy(string $id)
    {
        //
    }
}
