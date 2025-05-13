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
                        <label>Exam Type</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option selected="" disabled="">Select Exam Type</option>
                            @foreach (App\Enums\ExamType::cases() as $examType)
                                <option value="{{ $examType->value }}" @selected($course->exam_type === $examType->value)>{{ $examType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Exam Date</label>
                        <div class="input-group date datepicker" id="datePickerExample">
                            <input type="text" class="form-control"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Exam Start Time</label>
                                <div class="input-group date timepicker" id="datetimepickerStart" data-target-input="nearest">
                                    <input value="{{ $course->start_time }}" name="exam_start_time" type="text" class="form-control datetimepicker-input" data-target="#datetimepickerStart"/>
                                    <div class="input-group-append" data-target="#datetimepickerStart" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i data-feather="clock"></i></div>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Exam End Time</label>
                                <div class="input-group date timepicker" id="datetimepickerEnd" data-target-input="nearest">
                                    <input value="{{ $course->end_time }}" name="exam_end_time" type="text" class="form-control datetimepicker-input" data-target="#datetimepickerEnd"/>
                                    <div class="input-group-append" data-target="#datetimepickerEnd" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i data-feather="clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row py-3 my-2 border-bottom border-1 border-top">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputNumber1">Total</label>
                                <input min="0" type="number" class="form-control" value="{{ $course->total_students }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputNumber1">Withdraw</label>
                                <input min="0" type="number" class="form-control" value="{{ $course->withdraw_students }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputNumber1">Absent</label>
                                <input min="0" type="number" class="form-control" value="{{ $course->total_absent_students }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputNumber1">Present</label>
                                <input min="0" type="number" class="form-control" value="{{ $course->total_present_students }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputNumber1">Deprived</label>
                                <input min="0" type="number" class="form-control" value="{{ $course->total_deprived_students }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputNumber1">Incomplete</label>
                                <input min="0" type="number" class="form-control" value="{{ $course->incomplete_students }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input name="answer_papers_status" type="checkbox" class="form-check-input" @checked($course->answer_papers_status)>
                                        Answer Papers
                                        <i class="input-frame"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input name="year_work_status" type="checkbox" class="form-check-input" @checked($course->year_work_status)>
                                        Year Work
                                        <i class="input-frame"></i>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input name="model_answers_status" type="checkbox" class="form-check-input" @checked($course->model_answers_status)>
                                        Model Answers
                                        <i class="input-frame"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Cheating</label>
                                <input type="number" class="form-control" placeholder="Enter Cheating" value="{{ $course->cheating_students }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Misconduct</label>
                                <input type="number" class="form-control" placeholder="Enter Misconduct" value="{{ $course->misconduct_students }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Correction State</label>
                        <div class="col-sm-3">
                            <div class="form-check-warning form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="correction_status" type="radio" class="form-check-input" @checked($course->correction_status === \App\Enums\ProgressStatus::IN_PROGRESS->value)>
                                    In Progress
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-success form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="correction_status" type="radio" class="form-check-input" @checked($course->correction_status === \App\Enums\ProgressStatus::COMPLETED->value)>
                                    Completed
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-danger form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="correction_status" type="radio" class="form-check-input" @checked($course->correction_status === \App\Enums\ProgressStatus::NOT_STARTED->value)>
                                    Not Started
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Review State</label>
                        <div class="col-sm-3">
                            <div class="form-check-warning form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="review_status" type="radio" class="form-check-input" @checked($course->review_status === \App\Enums\ProgressStatus::IN_PROGRESS->value)>
                                    In Progress
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-success form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="review_status" type="radio" class="form-check-input" @checked($course->review_status === \App\Enums\ProgressStatus::COMPLETED->value)>
                                    Completed
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-danger form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="review_status" type="radio" class="form-check-input" @checked($course->review_status === \App\Enums\ProgressStatus::NOT_STARTED->value)>
                                    Not Started
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Final Grades State</label>
                        <div class="col-sm-3">
                            <div class="form-check-warning form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_status" type="radio" class="form-check-input" @checked($course->final_grades_status === \App\Enums\ProgressStatus::IN_PROGRESS->value)>
                                    In Progress
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-success form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_status" type="radio" class="form-check-input" @checked($course->final_grades_status === \App\Enums\ProgressStatus::COMPLETED->value)>
                                    Completed
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-danger form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_status" type="radio" class="form-check-input" @checked($course->final_grades_status === \App\Enums\ProgressStatus::NOT_STARTED->value)>
                                    Not Started
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Final Grades Review State</label>
                        <div class="col-sm-3">
                            <div class="form-check-warning form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_review_status" type="radio" class="form-check-input" @checked($course->final_grades_review_status === \App\Enums\ProgressStatus::IN_PROGRESS->value)>
                                    In Progress
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-success form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_review_status" type="radio" class="form-check-input" @checked($course->final_grades_review_status === \App\Enums\ProgressStatus::COMPLETED->value)>
                                    Completed
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-danger form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_review_status" type="radio" class="form-check-input" @checked($course->final_grades_review_status === \App\Enums\ProgressStatus::NOT_STARTED->value)>
                                    Not Started
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Notes</label>
                        <textarea class="form-control pt-3" id="exampleFormControlTextarea1" rows="10" name="notes">{{ $course->notes }}</textarea>
                    </div>

                    <button class="btn btn-primary" type="submit">Update</button>
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
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}">
@endsection