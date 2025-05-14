<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Enums\ExamType;
use App\Enums\ProgressStatus;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $examTypes = ExamType::cases();
        $courseLevels = [
            'level_0',
            'level_1',
            'level_2',
            'level_3',
            'level_4',
        ];
        $statuses = ProgressStatus::cases();

        for ($i = 0; $i < 5; $i++) {
            $start = rand(8, 11);
            $end = $start + rand(2, 4);
            $course = Course::create([
                'code' => 'CS' . rand(100, 999),
                'title' => 'Random Course ' . ($i + 1),
                'course_level' => $courseLevels[rand(0, 4)],
                'exam_type' => $examTypes[array_rand($examTypes)],
                'exam_date' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                'duration' => $start . ':' . $end,
                'total_students' => rand(30, 60),
                'answer_papers_status' => rand(0, 1),
                'year_work_status' => rand(0, 1),
                'model_answers_status' => rand(0, 1),
                'incomplete_students' => rand(0, 5),
                'withdraw_students' => rand(0, 3),
                'total_absent_students' => rand(0, 5),
                'total_present_students' => rand(25, 55),
                'total_deprived_students' => rand(0, 2),
                'cheating_students' => rand(0, 2),
                'misconduct_students' => rand(0, 2),
                'correction_status' => $statuses[array_rand($statuses)],
                'review_status' => $statuses[array_rand($statuses)],
                'final_grades_status' => $statuses[array_rand($statuses)],
                'final_grades_review_status' => $statuses[array_rand($statuses)],
                'notes' => 'Random course ' . ($i + 1)
            ]);
            
            $course->professors()->attach(rand(1, 10));
        }
    }
}
