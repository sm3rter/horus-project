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
        return view('courses.create');
    }

    private function prepareDate(array $data)
    {
        $data['exam_date'] = isset($data['exam_date']) ? Carbon::parse($data['exam_date'])->format('d M') : null;
        $data['exam_start_time'] = isset($data['exam_start_time']) ? (int)$data['exam_start_time'][0] + (int)$data['exam_start_time'][1]/60 : null;
        $data['exam_end_time'] = isset($data['exam_end_time']) ? (int)$data['exam_end_time'][0] + (int)$data['exam_end_time'][1]/60 : null;
        $data['duration'] = isset($data['exam_start_time']) && isset($data['exam_end_time']) ? $data['exam_start_time'] . ':' . $data['exam_end_time'] : null;
        
        if(isset($data['exam_start_time'])) {
            unset($data['exam_start_time']);
        }
        if(isset($data['exam_end_time'])) {
            unset($data['exam_end_time']);
        }
        
        foreach (['answer_papers_status', 'year_work_status', 'model_answers_status'] as $field) {
            $data[$field] = isset($data[$field]) && $data[$field] === 'on';
        }

        $data['is_published'] = isset($data['is_published']);

        return $data;
    }

    public function store(CourseStoreRequest $request)
    {
        Course::create($this->prepareDate($request->validated()));

        return back()->with(['status' => true, 'message' => 'Course created successfully']);
    }

    public function show(string $level, int $course)
    {        
        $course = Course::where('course_level', $level)->where('id', $course)->firstOrFail();
        
        return view('courses.show', compact('course'));
    }

    public function showLevel(string $level)
    {
        abort_if(!is_null($level) && !in_array($level, ['level_0', 'level_1', 'level_2', 'level_3', 'level_4']), 404);

        if(auth()->user()->isAdmin()) {
            $courses = Course::where('course_level', $level)->get();
        }else{
            $courses = auth()->user()->courses->where('course_level', $level);
        }
        
        return view('showLevel', compact('courses'));
    }

    public function update(CourseUpdateRequest $request, string $level, int $id)
    {
        $course = Course::where('course_level', $level)
                ->where('id', $id)
                ->firstOrFail();
                
        $course->update(
            $this->prepareDate(
                $request->validated()
            )
        );

        return to_route('courses.show', ['level' => $course->course_level, 'course' => $course->id])->with(['status' => true, 'message' => 'Course updated successfully']);
    }

    public function destroy(string $id)
    {
        //
    }
}
