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
        $selectedLevel = request()->query('selected_level') ?? '';

        return view('courses.create', compact('selectedLevel'));
    }

    private function prepareData(array $data)
    {
        $data['exam_date'] = isset($data['exam_date']) ? Carbon::parse($data['exam_date'])->format('d M') : null;
        
        if (isset($data['exam_start_time'])) {
            $time = Carbon::createFromFormat('h:i A', $data['exam_start_time']);
            $hours = (float)$time->format('G');
            $minutes = (float)$time->format('i');
            $data['exam_start_time'] = round($hours + ($minutes / 60), 1);
        }
        
        if (isset($data['exam_end_time'])) {
            $time = Carbon::createFromFormat('h:i A', $data['exam_end_time']);
            $hours = (float)$time->format('G');
            $minutes = (float)$time->format('i');
            $data['exam_end_time'] = round($hours + ($minutes / 60), 1);
        }

        if (isset($data['exam_start_time']) && isset($data['exam_end_time'])) {
            $data['duration'] = $data['exam_start_time'] . ' : ' .  $data['exam_end_time'];
        }

        foreach (['answer_papers_status', 'year_work_status', 'model_answers_status'] as $field) {
            $data[$field] = isset($data[$field]) && $data[$field] === 'on';
        }

        $data['is_published'] = isset($data['is_published']);

        return $data;
    }

    public function store(CourseStoreRequest $request)
    {
        Course::create($this->prepareData($request->validated()));

        return back()->with(['status' => true, 'message' => 'Course created successfully']);
    }

    public function show(Course $course)
    {                
        return view('courses.show', compact('course'));
    }

    public function update(CourseUpdateRequest $request, Course $course)
    {
        $course->update(
            $this->prepareData(
                $request->validated()
            )
        );

        return to_route('courses.show', $course->id)->with(['status' => true, 'message' => 'Course updated successfully']);
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return to_route('levels.show', $course->course_level)->with(['status' => true, 'message' => 'Course deleted successfully']);
    }
}
