@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <ul class="nav nav-tabs">
            @foreach(['level_0', 'level_1', 'level_2', 'level_3', 'level_4'] as $levelValue)
            <li class="nav-item">
                <a class="nav-link {{ $level == $levelValue ? 'active' : 'text-blueblack' }}"
                    href="{{ route('home', ['course_level' => $levelValue]) }}">
                    {{ ucfirst(str_replace('_', ' ', $levelValue)) }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    {{-- <div class="d-flex align-items-center flex-wrap text-nowrap">
        <button type="button" id="saveAsPDFButton" class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0">
            <i class="btn-icon-prepend" data-feather="printer"></i>
            Save as PDF
        </button>
    </div> --}}
</div>

<div class="row mt-3">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if($courses->isNotEmpty())
                <div class="table-responsive pt-3">
                    <table class="table table-bordered text-center" id="reportTable">
                        <thead>
                            <tr>
                                <th>✱</th>
                                <th>Type</th>
                                <th>Day</th>
                                <th>تاريخ الامتحان</th>
                                <th>الكود</th>
                                <th>المواد المتاحة بالكنترول</th>
                                <th class="table-danger">اجمالي</th>
                                <th>الوقت</th>
                                <th>تجهيز ورق الإجابة</th>
                                <th>اعمال السنة</th>
                                <th>نموذج الاجابة</th>
                                <th class="table-secondary">غير مكتمل</th>
                                <th class="table-secondary">انسحاب</th>
                                <th class="table-info">غياب</th>
                                <th class="table-warning">حضور</th>
                                <th class="table-warning">حرمان</th>
                                <th class="table-success">محضر غش</th>
                                <th class="table-success">محضر شغب</th>
                                <th>التصحيح</th>
                                <th>المراجعة</th>
                                <th>الرصد</th>
                                <th>مراجعة الرصد</th>
                                <th>ملاحظات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr>
                                <td @class([ 'bg-danger' => $course->created_at->diffInWeeks() >= 1 ])></td>
                                <td>{{ $course->exam_type }}</td>
                                <td>{{ $course->exam_date ? $course->exam_date->format('l') : '' }}</td>
                                <td>{{ $course->exam_date ? $course->exam_date->format('d M') : '' }}</td>
                                <td>{{ $course->code }}</td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->total_students }}</td>
                                <td>{{ $course->duration }}</td>
                                <td>{!! $course->answer_papers_status ? '<span class="text-success fs-1">✓</span>' : ''
                                    !!}</td>
                                <td>{!! $course->year_work_status ? '<span class="text-success fw-bold">✓</span>' : ''
                                    !!}</td>
                                <td>{!! $course->model_answers_status ? '<span class="text-success fw-bold">✓</span>' :
                                    '' !!}</td>
                                <td class="table-secondary">{{ $course->incomplete_students }}</td>
                                <td class="table-secondary">{{ $course->withdraw_students }}</td>
                                <td class="table-info">{{ $course->total_absent_students }}</td>
                                <td class="table-warning">{{ $course->total_present_students }}</td>
                                <td class="table-warning">{{ $course->total_deprived_students }}</td>
                                <td class="table-success">{{ $course->cheating_students }}</td>
                                <td class="table-success">{{ $course->misconduct_students }}</td>
                                <td>
                                    <div @class([ 'badge' , 'bg-success'=> $course->correction_status == 'completed',
                                        'bg-danger' => $course->correction_status == 'not_started',
                                        'bg-warning' => $course->correction_status == 'in_progress',
                                        'text-white' => $course->correction_status !== 'in_progress',
                                        ])>
                                        {{ ucfirst(str_replace('_', ' ', $course->correction_status)) }}
                                    </div>
                                </td>
                                <td>
                                    <div @class([ 'badge' , 'bg-success'=> $course->review_status == 'completed',
                                        'bg-danger' => $course->review_status == 'not_started',
                                        'bg-warning' => $course->review_status == 'in_progress',
                                        'text-white' => $course->review_status !== 'in_progress',
                                        ])>
                                        {{ ucfirst(str_replace('_', ' ', $course->review_status)) }}
                                    </div>
                                </td>
                                <td>
                                    <div @class([ 'badge' , 'bg-success'=> $course->final_grades_status == 'completed',
                                        'bg-danger' => $course->final_grades_status == 'not_started',
                                        'bg-warning' => $course->final_grades_status == 'in_progress',
                                        'text-white' => $course->final_grades_status !== 'in_progress',
                                        ])>
                                        {{ ucfirst(str_replace('_', ' ', $course->final_grades_status)) }}
                                    </div>
                                </td>
                                <td>
                                    <div @class([ 'badge' , 'bg-success'=> $course->final_grades_review_status ==
                                        'completed',
                                        'bg-danger' => $course->final_grades_review_status == 'not_started',
                                        'bg-warning' => $course->final_grades_review_status == 'in_progress',
                                        'text-white' => $course->final_grades_review_status !== 'in_progress',
                                        ])>
                                        {{ ucfirst(str_replace('_', ' ', $course->final_grades_review_status)) }}
                                    </div>
                                </td>
                                <td>{{ $course->notes }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-primary text-center" role="alert">
                    No data found
                </div>
                @endif
            </div>
        </div>
    </div>
</div>






<div class="row mt-3">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body" dir="rtl">
                @if($courses->isNotEmpty())
                <div class="table-responsive pt-3">
                    <table class="table table-bordered text-center align-middle" dir="rtl" style="vertical-align: middle;" id="reportTable2">
                        <thead>
                            <tr>
                                <th rowspan="2" class="table-info align-middle text-center">المقرر</th>
                                <th rowspan="2" class="table-info align-middle text-center">كود المقرر</th>
                                <th rowspan="2" class="table-info align-middle text-center">عدد الطلاب المسجلون</th>
                    
                                <th colspan="2" class="table-info align-middle text-center">حرمان ما قبل الامتحان</th>
                                <th colspan="2" class="table-info align-middle text-center">غير مكتمل</th>
                                <th colspan="2" class="table-info align-middle text-center">المنسحب</th>
                                <th colspan="2" class="table-info align-middle text-center">من لهم الحق في دخول الامتحان</th>
                                <th colspan="2" class="table-info align-middle text-center">الحضور</th>
                                <th colspan="2" class="table-info align-middle text-center">الغياب</th>
                                <th colspan="2" class="table-info align-middle text-center">الحرمان</th>
                                <th colspan="2" class="table-info align-middle text-center">نجاح</th>
                                <th colspan="2" class="table-info align-middle text-center">رسوب</th>
                            </tr>
                            <tr>
                                @for($i = 0; $i < 9; $i++)
                                <th class="table-info align-middle text-center">عدد</th>
                                <th class="table-info align-middle text-center">نسبة</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr {!! $course->created_at->diffInWeeks() >= 1 ? 'class="bg-danger text-white"' : '' !!}>
                                <td class="align-middle text-center">{{ $course->title }}</td>
                                <td class="align-middle text-center">{{ $course->code }}</td>
                                <td class="align-middle text-center">{{ $course->total_students }}</td>
                    
                                <td class="align-middle text-center">{{ $course->total_deprived_students }}</td>
                                <td class="align-middle text-center">{{ $course->total_students > 0 ? number_format(($course->total_deprived_students / $course->total_students) * 100, 2) : 0 }}%</td>
                    
                                <td class="align-middle text-center">{{ $course->incomplete_students }}</td>
                                <td class="align-middle text-center">{{ $course->total_students > 0 ? number_format(($course->incomplete_students / $course->total_students) * 100, 2) : 0 }}%</td>

                                <td class="align-middle text-center">{{ $course->withdraw_students }}</td>
                                <td class="align-middle text-center">{{ $course->total_students > 0 ? number_format(($course->withdraw_students / $course->total_students) * 100, 2) : 0 }}%</td>
                                
                                <td class="align-middle text-center">{{ $course->total_eligible_students }}</td>
                                <td class="align-middle text-center">{{ $course->total_students > 0 ? number_format(($course->total_eligible_students / $course->total_students) * 100, 2) : 0 }}%</td>

                                <td class="align-middle text-center">{{ $course->total_present_students }}</td>
                                <td class="align-middle text-center">{{ $course->total_eligible_students > 0 ? number_format(($course->total_present_students / $course->total_eligible_students) * 100, 2) : 0 }}%</td>

                                <td class="align-middle text-center">{{ $course->total_absent_students }}</td>
                                <td class="align-middle text-center">{{ $course->total_eligible_students > 0 ? number_format(($course->total_absent_students / $course->total_eligible_students) * 100, 2) : 0 }}%</td>

                                <td class="align-middle text-center">{{ $course->cheating_students }}</td>
                                <td class="align-middle text-center">{{ $course->total_eligible_students > 0 ? number_format(($course->cheating_students / $course->total_eligible_students) * 100, 2) : 0 }}%</td>

                                <td class="align-middle text-center">{{ $course->success_students }}</td>
                                <td class="align-middle text-center {{ !($course->created_at->diffInWeeks() >= 1) ? ($course->total_eligible_students > 0 ? ($course->success_students / $course->total_eligible_students >= 0.50 ? 'table-success' : 'table-danger') : '') : '' }}">{{ $course->total_eligible_students > 0 ? number_format(($course->success_students / $course->total_eligible_students) * 100, 2) : 0 }}%</td>

                                <td class="align-middle text-center">{{ $course->failed_students }}</td>
                                <td class="align-middle text-center {{ !($course->created_at->diffInWeeks() >= 1) ? ($course->total_eligible_students > 0 ? ($course->failed_students / $course->total_eligible_students >= 0.50 ? 'table-danger' : 'table-success') : '') : '' }}">{{ $course->total_eligible_students > 0 ? number_format(($course->failed_students / $course->total_eligible_students) * 100, 2) : 0 }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-primary text-center" role="alert">
                    No data found
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<style>
    .text-blueblack {
        color: #292558;
        font-weight: 600;
    }
</style>
@endsection