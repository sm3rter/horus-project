@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="text-uppercase mb-4 font-weight-bolder text-center pt-1">Add New Course</h4>
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <code>*</code>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Course Title" value="{{ old('title') }}">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Code</label>
                        <code>*</code>
                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Course Code" value="{{ old('code') }}">
                        @error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <code>*</code>
                        <select name="course_level" class="form-control @error('course_level') is-invalid @enderror" id="exampleFormControlSelect1">
                            <option selected="" disabled="">Select Level</option>
                            @foreach($levels as $level)
                                <option value="{{ $level->name }}" {{ old('course_level') == $level->name ? 'selected' : ($selectedLevel == $level->name ? 'selected' : '') }}>
                                    {{ ucfirst(str_replace('_', ' ', $level->name)) }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Exam Type</label>
                        <select name="exam_type" class="form-control @error('exam_type') is-invalid @enderror" id="exampleFormControlSelect1">
                            <option selected="" disabled="">Select Exam Type</option>
                            @foreach (\App\Enums\ExamType::cases() as $examType)
                                <option value="{{ $examType->value }}">{{ $examType->name }}</option>
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
                            <input placeholder="Select Exam Date" name="exam_date" type="text" class="form-control @error('exam_date') is-invalid @enderror"><span class="input-group-addon"><i data-feather="calendar"></i></span>
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
                                    <input placeholder="Select Exam Start Time" name="exam_start_time" type="text" class="form-control datetimepicker-input" data-target="#datetimepickerStart"/>
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
                                    <input placeholder="Select Exam End Time" name="exam_end_time" type="text" class="form-control datetimepicker-input" data-target="#datetimepickerEnd"/>
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
                                <input placeholder="Present" min="0" type="number" name="total_present_students" value="{{ old('total_present_students', 0) }}" class="form-control @error('total_present_students') is-invalid @enderror">
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
                                <input placeholder="Absent" min="0" type="number" name="total_absent_students" value="{{ old('total_absent_students', 0) }}" class="form-control @error('total_absent_students') is-invalid @enderror">
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
                                <input placeholder="Withdraw" min="0" type="number" name="withdraw_students" value="{{ old('withdraw_students', 0) }}" class="form-control @error('withdraw_students') is-invalid @enderror">
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
                                <input placeholder="Incomplete" min="0" type="number" name="incomplete_students" value="{{ old('incomplete_students', 0) }}" class="form-control @error('incomplete_students') is-invalid @enderror">
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
                                <input placeholder="Deprived" min="0" type="number" name="total_deprived_students" value="{{ old('total_deprived_students', 0) }}" class="form-control @error('total_deprived_students') is-invalid @enderror">
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
                                <input placeholder="Total" min="0" type="number" name="total_students" value="{{ old('total_students', 0) }}" class="form-control @error('total_students') is-invalid @enderror">
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
                                        <input name="answer_papers_status" @checked(old('answer_papers_status')) type="checkbox" class="form-check-input @error('answer_papers_status') is-invalid @enderror">
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
                                        <input name="year_work_status" @checked(old('year_work_status')) type="checkbox" class="form-check-input @error('year_work_status') is-invalid @enderror">
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
                                        <input name="model_answers_status" @checked(old('model_answers_status')) type="checkbox" class="form-check-input @error('model_answers_status') is-invalid @enderror">
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
                                <input name="cheating_students" type="number" class="form-control @error('cheating_students') is-invalid @enderror" placeholder="Enter Cheating" value="{{ old('cheating_students', 0) }}">
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
                                <input name="misconduct_students" type="number" class="form-control @error('misconduct_students') is-invalid @enderror" placeholder="Enter Misconduct" value="{{ old('misconduct_students', 0) }}">
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
                            <div class="form-check-danger form-check form-check-inline">
                                <label class="form-check-label">
                                    <input checked="true" @selected(old('correction_status') == \App\Enums\ProgressStatus::NOT_STARTED->value) name="correction_status" value="{{ \App\Enums\ProgressStatus::NOT_STARTED->value }}" type="radio" class="form-check-input">
                                    Not Started
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-warning form-check form-check-inline">
                                <label class="form-check-label">
                                    <input @selected(old('correction_status') == \App\Enums\ProgressStatus::IN_PROGRESS->value) name="correction_status" value="{{ \App\Enums\ProgressStatus::IN_PROGRESS->value }}" type="radio" class="form-check-input">
                                    In Progress
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-success form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="correction_status" value="{{ \App\Enums\ProgressStatus::COMPLETED->value }}" type="radio" class="form-check-input">
                                    Completed
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
                            <div class="form-check-danger form-check form-check-inline">
                                <label class="form-check-label">
                                    <input checked="true" name="review_status" value="{{ \App\Enums\ProgressStatus::NOT_STARTED->value }}" type="radio" class="form-check-input">
                                    Not Started
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-warning form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="review_status" value="{{ \App\Enums\ProgressStatus::IN_PROGRESS->value }}" type="radio" class="form-check-input">
                                    In Progress
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-success form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="review_status" value="{{ \App\Enums\ProgressStatus::COMPLETED->value }}" type="radio" class="form-check-input">
                                    Completed
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
                            <div class="form-check-danger form-check form-check-inline">
                                <label class="form-check-label">
                                    <input checked="true" name="final_grades_status" value="{{ \App\Enums\ProgressStatus::NOT_STARTED->value }}" type="radio" class="form-check-input">
                                    Not Started
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-warning form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_status" value="{{ \App\Enums\ProgressStatus::IN_PROGRESS->value }}" type="radio" class="form-check-input">
                                    In Progress
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-success form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_status" value="{{ \App\Enums\ProgressStatus::COMPLETED->value }}" type="radio" class="form-check-input">
                                    Completed
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
                            <div class="form-check-danger form-check form-check-inline">
                                <label class="form-check-label">
                                    <input checked="true" name="final_grades_review_status" value="{{ \App\Enums\ProgressStatus::NOT_STARTED->value }}" type="radio" class="form-check-input">
                                    Not Started
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-warning form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_review_status" value="{{ \App\Enums\ProgressStatus::IN_PROGRESS->value }}" type="radio" class="form-check-input">
                                    In Progress
                                    <i class="input-frame"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-check-success form-check form-check-inline">
                                <label class="form-check-label">
                                    <input name="final_grades_review_status" value="{{ \App\Enums\ProgressStatus::COMPLETED->value }}" type="radio" class="form-check-input">
                                    Completed
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
                                <input name="success_students" type="number" class="form-control @error('success_students') is-invalid @enderror" placeholder="Enter Success">
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
                                <input name="failed_students" type="number" class="form-control @error('failed_students') is-invalid @enderror" placeholder="Enter Failed">
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
                        <textarea class="form-control pt-3 @error('notes') is-invalid @enderror" id="exampleFormControlTextarea1" rows="10" name="notes"></textarea>
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
<script src="{{ asset('assets/js/course-validation.js') }}"></script>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}">
@endsection