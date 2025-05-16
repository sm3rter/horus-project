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
        $courses = [
            'level_0' => [
                'intro_engineering' => [
                    'title' => 'Introduction to Engineering',
                    'code' => 'ENG101'
                ],
                'math_fundamentals' => [
                    'title' => 'Mathematics Fundamentals',
                    'code' => 'MATH101'
                ],
                'physics_fundamentals' => [
                    'title' => 'Physics Fundamentals',
                    'code' => 'PHY101'
                ],
                'chemistry_engineers' => [
                    'title' => 'Chemistry for Engineers',
                    'code' => 'CHEM101'
                ],
                'computer_basics' => [
                    'title' => 'Computer Basics',
                    'code' => 'CS101'
                ],
                'technical_drawing' => [
                    'title' => 'Technical Drawing',
                    'code' => 'TD101'
                ],
                'communication_skills' => [
                    'title' => 'Communication Skills',
                    'code' => 'COMM101'
                ]
            ],
            'level_1' => [
                'calculus' => [
                    'title' => 'Calculus I & II',
                    'code' => 'MATH201'
                ],
                'linear_algebra' => [
                    'title' => 'Linear Algebra',
                    'code' => 'MATH202'
                ],
                'engineering_physics' => [
                    'title' => 'Engineering Physics',
                    'code' => 'PHY201'
                ],
                'engineering_chemistry' => [
                    'title' => 'Engineering Chemistry',
                    'code' => 'CHEM201'
                ],
                'engineering_mechanics' => [
                    'title' => 'Engineering Mechanics',
                    'code' => 'MECH201'
                ],
                'programming_engineers' => [
                    'title' => 'Programming for Engineers (C/C++/Python)',
                    'code' => 'CS201'
                ],
                'electrical_circuits' => [
                    'title' => 'Electrical Circuits',
                    'code' => 'EE201'
                ],
                'workshop_practice' => [
                    'title' => 'Workshop Practice',
                    'code' => 'WP201'
                ]
            ],
            'level_2' => [
                'differential_equations' => [
                    'title' => 'Differential Equations',
                    'code' => 'MATH301'
                ],
                'thermodynamics' => [
                    'title' => 'Thermodynamics',
                    'code' => 'THERM301'
                ],
                'strength_materials' => [
                    'title' => 'Strength of Materials',
                    'code' => 'MECH301'
                ],
                'digital_logic' => [
                    'title' => 'Digital Logic Design',
                    'code' => 'EE301'
                ],
                'electronics' => [
                    'title' => 'Electronics',
                    'code' => 'EE302'
                ],
                'fluid_mechanics' => [
                    'title' => 'Fluid Mechanics',
                    'code' => 'MECH302'
                ],
                'data_structures' => [
                    'title' => 'Data Structures and Algorithms',
                    'code' => 'CS301'
                ],
                'material_science' => [
                    'title' => 'Material Science',
                    'code' => 'MS301'
                ]
            ],
            'level_3' => [
                'control_systems' => [
                    'title' => 'Control Systems',
                    'code' => 'EE401'
                ],
                'heat_transfer' => [
                    'title' => 'Heat Transfer',
                    'code' => 'THERM401'
                ],
                'microprocessors' => [
                    'title' => 'Microprocessors and Microcontrollers',
                    'code' => 'EE402'
                ],
                'machine_design' => [
                    'title' => 'Machine Design',
                    'code' => 'MECH401'
                ],
                'embedded_systems' => [
                    'title' => 'Embedded Systems',
                    'code' => 'CS401'
                ],
                'signals_systems' => [
                    'title' => 'Signals and Systems',
                    'code' => 'EE403'
                ],
                'environmental_engineering' => [
                    'title' => 'Environmental Engineering',
                    'code' => 'ENV401'
                ],
                'project_management' => [
                    'title' => 'Project Management',
                    'code' => 'PM401'
                ]
            ],
            'level_4' => [
                'capstone_project' => [
                    'title' => 'Capstone Design Project',
                    'code' => 'CP501'
                ],
                'engineering_ethics' => [
                    'title' => 'Engineering Ethics',
                    'code' => 'ETH501'
                ],
                'industrial_training' => [
                    'title' => 'Industrial Training / Internship',
                    'code' => 'IT501'
                ],
                'elective_1' => [
                    'title' => 'Elective I (e.g., Renewable Energy Systems)',
                    'code' => 'EL501'
                ],
                'elective_2' => [
                    'title' => 'Elective II (e.g., Artificial Intelligence in Engineering)',
                    'code' => 'EL502'
                ],
                'thesis_project' => [
                    'title' => 'Thesis / Research Project',
                    'code' => 'TH501'
                ],
                'entrepreneurship' => [
                    'title' => 'Entrepreneurship and Innovation',
                    'code' => 'ENT501'
                ]
            ]
        ];

        $examTypes = ExamType::cases();
        $statuses = ProgressStatus::cases();

        foreach ($courses as $courseLevel => $levelCourses) {
            foreach ($levelCourses as $course) {
                $start = rand(8, 11);
                $end = $start + rand(2, 4);

                $total_students = rand(30, 60);
                $total_deprived_students = rand(0, 2);
                $incomplete_students = rand(0, 5);
                $withdraw_students = rand(0, 3);
                
                $total_eligible_students = $total_students - ($total_deprived_students + $incomplete_students + $withdraw_students);

                $success_students = (int)($total_eligible_students * 0.7);
                $failed_students = $total_eligible_students - $success_students;
                
                Course::create([
                    'code' => $course['code'],
                    'title' => $course['title'],
                    'course_level' => $courseLevel,
                    'exam_type' => $examTypes[array_rand($examTypes)],
                    'exam_date' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                    'duration' => $start . ':' . $end,
                    'total_students' => $total_students,
                    'answer_papers_status' => rand(0, 1),
                    'year_work_status' => rand(0, 1),
                    'model_answers_status' => rand(0, 1),
                    'incomplete_students' => $incomplete_students,
                    'withdraw_students' => $withdraw_students,
                    'total_absent_students' => rand(0, 5),
                    'total_present_students' => rand(25, 55),
                    'total_deprived_students' => $total_deprived_students,
                    'cheating_students' => rand(0, 2),
                    'misconduct_students' => rand(0, 2),
                    'success_students' => $success_students,
                    'failed_students' => $failed_students,
                    'correction_status' => $statuses[array_rand($statuses)],
                    'review_status' => $statuses[array_rand($statuses)],
                    'final_grades_status' => $statuses[array_rand($statuses)],
                    'final_grades_review_status' => $statuses[array_rand($statuses)],
                    'notes' => 'Notes for ' . $course['title'],
                    'is_published' => true,
                    'is_checked_by_dean' => rand(0, 1)
                ]);
            }
        }
    }
}
