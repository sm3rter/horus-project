<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'exam_type',
        'exam_date',
        'code',
        'title',
        'total_students',
        'duration',
        'answer_papers_status',
        'year_work_status',
        'model_answers_status',
        'incomplete_students',
        'withdraw_students',
        'total_absent_students',
        'total_present_students',
        'total_deprived_students',
        'cheating_students',
        'misconduct_students',
        'correction_status',
        'review_status',
        'final_grades_status',
        'final_grades_review_status',
        'notes',
        'course_level',
        'success_students',
        'failed_students',
        'is_published',
        'is_checked_by_dean',
    ];

    
    public function getStartTimeAttribute()
    {
        $times = array_filter(explode(':', $this->duration));
        if (empty($times)) {
            return null;
        }

        return $times[0];
    }

    public function getEndTimeAttribute()
    {
        $times = array_filter(explode(':', $this->duration));
        if (empty($times)) {
            return null;
        }
        return $times[1] <= $times[0] ? $times[1] + 12 : $times[1];
    }

    public function getTotalEligibleStudentsAttribute()
    {
        return $this->total_students - ($this->total_deprived_students + $this->incomplete_students + $this->withdraw_students);
    }

    protected function casts()
    {
        return [
            'model_answers_status' => 'boolean',
            'answer_papers_status' => 'boolean',
            'year_work_status' => 'boolean',
            'exam_date' => 'date',
        ];
    }
}
