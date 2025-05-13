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
    ];

    public function professors()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    public function getStartTimeAttribute()
    {
        return explode(':', $this->duration)[0];
    }

    public function getEndTimeAttribute()
    {
        $times = explode(':', $this->duration);
        return $times[1] <= $times[0] ? $times[1] + 12 : $times[1];
    }
}
