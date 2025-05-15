<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CourseUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('update-course', $this->route('course'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'exam_type' => ['required', Rule::enum(\App\Enums\ExamType::class)],
            'exam_date' => 'required|string',
            'exam_start_time' => 'required|string',
            'exam_end_time' => 'required|string',
            'cheating_students' => 'nullable|integer',
            'misconduct_students' => 'nullable|integer',
            'correction_status' => ['required', Rule::enum(\App\Enums\ProgressStatus::class)],
            'review_status' => ['required', Rule::enum(\App\Enums\ProgressStatus::class)],
            'final_grades_status' => ['required', Rule::enum(\App\Enums\ProgressStatus::class)],
            'final_grades_review_status' => ['required', Rule::enum(\App\Enums\ProgressStatus::class)],
            'notes' => 'nullable|string|max:255',
            'withdraw_students' => 'nullable|integer|min:0',
            'success_students' => 'nullable|integer|min:0',
            'failed_students' => 'nullable|integer|min:0',
            'total_absent_students' => 'nullable|integer|min:0',
            'total_present_students' => 'nullable|integer|min:0',
            'total_deprived_students' => 'nullable|integer|min:0',
            'incomplete_students' => 'nullable|integer|min:0',
            'total_students' => 'required|integer|min:0',
            'answer_papers_status' => 'nullable',
            'year_work_status' => 'nullable',
            'model_answers_status' => 'nullable',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $sum = $this->input('withdraw_students') +
                   $this->input('total_absent_students') +
                   $this->input('total_present_students') +
                   $this->input('total_deprived_students') +
                   $this->input('incomplete_students');

            if ($sum !== (int) $this->input('total_students')) {
                $validator->errors()->add(
                    'total_students',
                    'The sum of withdraw, absent, present, deprived, and incomplete students must equal the total number of students ('.$sum.')'
                );
            }
        });
    }
}
