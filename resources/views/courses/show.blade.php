@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('levels.showLevel', $course->course_level) }}">{{ $course->course_level }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $course->title }}</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="text-uppercase mb-4 font-weight-bolder">{{ $course->title }} <span class="text-muted" style="font-size: 1rem;">({{ $course->code }})</span></h4>
                <form action="{{ route('courses.update', ['level' => $course->course_level, 'course' => $course->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Course Code</label>
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ $course->code }}">
                        @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Course Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $course->title }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Course Level</label>
                        <select name="course_level" class="form-control @error('course_level') is-invalid @enderror" id="exampleFormControlSelect1">
                            @foreach (['level_0', 'level_1', 'level_2', 'level_3', 'level_4'] as $courseLevel)
                                <option value="{{ $courseLevel }}" @selected($course->course_level === $courseLevel)>{{ ucfirst(str_replace('_', ' ', $courseLevel)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Exam Type</label>
                        <select name="exam_type" class="form-control @error('exam_type') is-invalid @enderror" id="exampleFormControlSelect1">
                            <option selected="" disabled="">Select Exam Type</option>
                            @foreach (\App\Enums\ExamType::cases() as $examType)
                                <option value="{{ $examType->value }}" @selected($course->exam_type === $examType->value)>{{ $examType->name }}</option>
                            @endforeach
                        </select>
                        @error('exam_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Exam Date</label>
                        <div class="input-group date datepicker" id="datePickerExample">
                            <input value="{{ $course->exam_date ? $course->exam_date->format('d M') : '' }}" name="exam_date" type="text" class="form-control @error('exam_date') is-invalid @enderror"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                            @error('exam_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Exam Start Time</label>
                                <div class="input-group date timepicker @error('exam_start_time') is-invalid @enderror" id="datetimepickerStart" data-target-input="nearest">
                                    <input value="{{ $course->start_time ?? '' }}" name="exam_start_time" type="text" class="form-control datetimepicker-input" data-target="#datetimepickerStart"/>
                                    <div class="input-group-append" data-target="#datetimepickerStart" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i data-feather="clock"></i></div>
                                    </div>
                                </div>
                                @error('exam_start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Exam End Time</label>
                                <div class="input-group date timepicker @error('exam_end_time') is-invalid @enderror" id="datetimepickerEnd" data-target-input="nearest">
                                    <input value="{{ $course->end_time ?? '' }}" name="exam_end_time" type="text" class="form-control datetimepicker-input" data-target="#datetimepickerEnd"/>
                                    <div class="input-group-append" data-target="#datetimepickerEnd" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i data-feather="clock"></i></div>
                                    </div>
                                </div>
                                @error('exam_end_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row py-3 my-2 border-bottom border-1 border-top">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputNumber1">Present</label>
                                <input min="0" type="number" name="total_present_students" class="form-control @error('total_present_students') is-invalid @enderror" value="{{ $course->total_present_students }}">
                                @error('total_present_students')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputNumber1">Absent</label>
                                <input min="0" type="number" name="total_absent_students" class="form-control @error('total_absent_students') is-invalid @enderror" value="{{ $course->total_absent_students }}">
                                @error('total_absent_students')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputNumber1">Withdraw</label>
                                <input min="0" type="number" name="withdraw_students" class="form-control @error('withdraw_students') is-invalid @enderror" value="{{ $course->withdraw_students }}">
                                @error('withdraw_students')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputNumber1">Incomplete</label>
                                <input min="0" type="number" name="incomplete_students" class="form-control @error('incomplete_students') is-invalid @enderror" value="{{ $course->incomplete_students }}">
                                @error('incomplete_students')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputNumber1">Deprived</label>
                                <input min="0" type="number" name="total_deprived_students" class="form-control @error('total_deprived_students') is-invalid @enderror" value="{{ $course->total_deprived_students }}">
                                @error('total_deprived_students')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputNumber1">Total</label>
                                <input min="0" type="number" name="total_students" class="form-control @error('total_students') is-invalid @enderror" value="{{ $course->total_students }}">
                                @error('total_students')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input name="answer_papers_status" type="checkbox" class="form-check-input @error('answer_papers_status') is-invalid @enderror" @checked($course->answer_papers_status)>
                                        Answer Papers
                                        <i class="input-frame"></i>
                                    </label>
                                    @error('answer_papers_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input name="year_work_status" type="checkbox" class="form-check-input @error('year_work_status') is-invalid @enderror" @checked($course->year_work_status)>
                                        Year Work
                                        <i class="input-frame"></i>
                                    </label>
                                    @error('year_work_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input name="model_answers_status" type="checkbox" class="form-check-input @error('model_answers_status') is-invalid @enderror" @checked($course->model_answers_status)>
                                        Model Answers
                                        <i class="input-frame"></i>
                                    </label>
                                    @error('model_answers_status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Cheating</label>
                                <input name="cheating_students" type="number" class="form-control @error('cheating_students') is-invalid @enderror" placeholder="Enter Cheating" value="{{ $course->cheating_students }}">
                                @error('cheating_students')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Misconduct</label>
                                <input name="misconduct_students" type="number" class="form-control @error('misconduct_students') is-invalid @enderror" placeholder="Enter Misconduct" value="{{ $course->misconduct_students }}">
                                @error('misconduct_students')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Correction State</label>
                        <div class="col-sm-3">
                            <div class="form-check-warning form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="correction_status" value="{{ \App\Enums\ProgressStatus::IN_PROGRESS->value }}" type="radio" class="form-check-input" @checked($course->correction_status === \App\Enums\ProgressStatus::IN_PROGRESS->value)>
                                    In Progress
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-success form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="correction_status" value="{{ \App\Enums\ProgressStatus::COMPLETED->value }}" type="radio" class="form-check-input" @checked($course->correction_status === \App\Enums\ProgressStatus::COMPLETED->value)>
                                    Completed
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-danger form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="correction_status" value="{{ \App\Enums\ProgressStatus::NOT_STARTED->value }}" type="radio" class="form-check-input" @checked($course->correction_status === \App\Enums\ProgressStatus::NOT_STARTED->value)>
                                    Not Started
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        @error('correction_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Review State</label>
                        <div class="col-sm-3">
                            <div class="form-check-warning form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="review_status" value="{{ \App\Enums\ProgressStatus::IN_PROGRESS->value }}" type="radio" class="form-check-input" @checked($course->review_status === \App\Enums\ProgressStatus::IN_PROGRESS->value)>
                                    In Progress
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-success form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="review_status" value="{{ \App\Enums\ProgressStatus::COMPLETED->value }}" type="radio" class="form-check-input" @checked($course->review_status === \App\Enums\ProgressStatus::COMPLETED->value)>
                                    Completed
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-danger form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="review_status" value="{{ \App\Enums\ProgressStatus::NOT_STARTED->value }}" type="radio" class="form-check-input" @checked($course->review_status === \App\Enums\ProgressStatus::NOT_STARTED->value)>
                                    Not Started
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        @error('review_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Final Grades State</label>
                        <div class="col-sm-3">
                            <div class="form-check-warning form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_status" value="{{ \App\Enums\ProgressStatus::IN_PROGRESS->value }}" type="radio" class="form-check-input" @checked($course->final_grades_status === \App\Enums\ProgressStatus::IN_PROGRESS->value)>
                                    In Progress
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-success form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_status" value="{{ \App\Enums\ProgressStatus::COMPLETED->value }}" type="radio" class="form-check-input" @checked($course->final_grades_status === \App\Enums\ProgressStatus::COMPLETED->value)>
                                    Completed
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-danger form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_status" value="{{ \App\Enums\ProgressStatus::NOT_STARTED->value }}" type="radio" class="form-check-input" @checked($course->final_grades_status === \App\Enums\ProgressStatus::NOT_STARTED->value)>
                                    Not Started
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        @error('final_grades_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row border-bottom border-2 mb-3">
                        <label class="col-sm-3 col-form-label">Final Grades Review State</label>
                        <div class="col-sm-3">
                            <div class="form-check-warning form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_review_status" value="{{ \App\Enums\ProgressStatus::IN_PROGRESS->value }}" type="radio" class="form-check-input" @checked($course->final_grades_review_status === \App\Enums\ProgressStatus::IN_PROGRESS->value)>
                                    In Progress
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-success form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_review_status" value="{{ \App\Enums\ProgressStatus::COMPLETED->value }}" type="radio" class="form-check-input" @checked($course->final_grades_review_status === \App\Enums\ProgressStatus::COMPLETED->value)>
                                    Completed
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-danger form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_review_status" value="{{ \App\Enums\ProgressStatus::NOT_STARTED->value }}" type="radio" class="form-check-input" @checked($course->final_grades_review_status === \App\Enums\ProgressStatus::NOT_STARTED->value)>
                                    Not Started
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        @error('final_grades_review_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Success Students</label>
                                <input name="success_students" type="number" class="form-control @error('success_students') is-invalid @enderror" placeholder="Enter Success" value="{{ $course->success_students }}">
                                @error('success_students')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Failed Students</label>
                                <input name="failed_students" type="number" class="form-control @error('failed_students') is-invalid @enderror" placeholder="Enter Failed" value="{{ $course->failed_students }}">
                                @error('failed_students')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Notes</label>
                        <textarea class="form-control pt-3 @error('notes') is-invalid @enderror" id="exampleFormControlTextarea1" rows="10" name="notes">{{ $course->notes }}</textarea>
                        @error('notes')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-outline-primary btn-icon-text">
                        <i class="btn-icon-prepend" data-feather="save"></i>
                        Save as draft
                    </button>
    
                    <button type="submit" name="is_published" value="1" class="btn btn-primary btn-icon-text">
                        <i class="btn-icon-prepend" data-feather="upload"></i>
                        Publish
                    </button>
    
                    <p class="text-muted tx-13 my-3 mb-md-0">
                        <b>Note :</b> Published courses are visible to Dean
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/timepicker.js') }}"></script>
<script>
    // Function to calculate total
    function calculateTotal() {
        const present = parseInt(document.querySelector('input[name="total_present_students"]').value) || 0;
        const absent = parseInt(document.querySelector('input[name="total_absent_students"]').value) || 0;
        const withdraw = parseInt(document.querySelector('input[name="withdraw_students"]').value) || 0;
        const incomplete = parseInt(document.querySelector('input[name="incomplete_students"]').value) || 0;
        const deprived = parseInt(document.querySelector('input[name="total_deprived_students"]').value) || 0;

        const total = present + absent + withdraw + incomplete + deprived;
        const totalInput = document.querySelector('input[name="total_students"]');
        totalInput.value = total;
        
        // Remove any existing error message
        const existingError = totalInput.parentElement.querySelector('.total-error');
        if (existingError) {
            existingError.remove();
        }
    }

    // Function to validate total
    function validateTotal() {
        const present = parseInt(document.querySelector('input[name="total_present_students"]').value) || 0;
        const absent = parseInt(document.querySelector('input[name="total_absent_students"]').value) || 0;
        const withdraw = parseInt(document.querySelector('input[name="withdraw_students"]').value) || 0;
        const incomplete = parseInt(document.querySelector('input[name="incomplete_students"]').value) || 0;
        const deprived = parseInt(document.querySelector('input[name="total_deprived_students"]').value) || 0;
        const totalInput = document.querySelector('input[name="total_students"]');
        const enteredTotal = parseInt(totalInput.value) || 0;

        const calculatedTotal = present + absent + withdraw + incomplete + deprived;

        // Remove any existing error message
        const existingError = totalInput.parentElement.querySelector('.total-error');
        if (existingError) {
            existingError.remove();
        }

        if (enteredTotal !== calculatedTotal) {
            // Add error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback total-error';
            errorDiv.style.display = 'block';
            errorDiv.innerHTML = `<strong>Total must equal the sum of all student counts (${calculatedTotal})</strong>`;
            totalInput.classList.add('is-invalid');
            totalInput.parentElement.appendChild(errorDiv);
            return false;
        } else {
            totalInput.classList.remove('is-invalid');
            return true;
        }
    }

    // Add event listeners to all student count inputs
    const studentInputs = [
        'total_present_students',
        'total_absent_students',
        'withdraw_students',
        'incomplete_students',
        'total_deprived_students'
    ];

    studentInputs.forEach(inputName => {
        document.querySelector(`input[name="${inputName}"]`).addEventListener('input', calculateTotal);
    });

    // Add validation on total input change
    document.querySelector('input[name="total_students"]').addEventListener('input', validateTotal);

    // Add form validation before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!validateTotal()) {
            e.preventDefault();
        }
    });

    // Calculate initial total on page load
    document.addEventListener('DOMContentLoaded', calculateTotal);
</script>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}">
@endsection