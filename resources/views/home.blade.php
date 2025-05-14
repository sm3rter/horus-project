@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <ul class="nav nav-tabs">
            @foreach(['level_0', 'level_1', 'level_2', 'level_3', 'level_4'] as $levelValue)
                <li class="nav-item">
                    <a class="nav-link {{ $level == $levelValue ? 'active' : '' }}" 
                       href="{{ route('home', ['course_level' => $levelValue]) }}">
                        {{ ucfirst(str_replace('_', ' ', $levelValue)) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    {{-- <div class="d-flex align-items-center flex-wrap text-nowrap">
      <button type="button" class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0">
        <i class="btn-icon-prepend" data-feather="printer"></i>
        Print
      </button>
      <button type="button" id="export2xlsxButton" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
        <i class="btn-icon-prepend" data-feather="file"></i>
        Export to Excel
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
                                <th>
                                    Type                    
                                </th>
                                <th>
                                    Day
                                </th>
                                <th>
                                    تاريخ الامتحان
                                </th>
                                <th>
                                    الكود
                                </th>
                                <th>
                                     المواد المتاحة بالكنترول
                                </th>
                                <th class="table-danger">
                                    اجمالي
                                </th>
                                <th>
                                    الوقت
                                </th>
                                <th>
                                    تجهيز ورق الإجابة
                                </th>
                                <th>
                                    اعمال السنة
                                </th>
                                <th>
                                    نموذج الاجابة
                                </th>
                                <th class="table-secondary">
                                    غير مكتمل
                                </th>
                                <th class="table-secondary">
                                    انسحاب
                                </th>
                                <th class="table-info">
                                    غياب
                                </th>
                                <th class="table-warning">
                                    حضور
                                </th>
                                <th class="table-warning">
                                    حرمان
                                </th>
                                <th class="table-success">
                                    محضر غش
                                </th>
                                <th class="table-success">
                                    محضر شغب
                                </th>
                                <th>
                                    التصحيح
                                </th>
                                <th>
                                    المراجعة
                                </th>
                                <th>
                                    الرصد
                                </th>
                                <th>
                                    مراجعة الرصد
                                </th>
                                <th>
                                    ملاحظات
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                                <tr>
                                    <td>
                                        {{ $course->exam_type }}
                                    </td>
                                    <td>
                                        {{ $course->exam_date->format('l') }}
                                    </td>
                                    <td>
                                        {{ $course->exam_date->format('d M') }}
                                    </td>
                                    <td>
                                        {{ $course->code }}
                                    </td>
                                    <td>
                                        {{ $course->title }}
                                    </td>
                                    <td>
                                        {{ $course->total_students }}
                                    </td>
                                    <td>
                                        {{ $course->duration }}
                                    </td>
                                    <td>
                                        {!! $course->answer_papers_status ? '<span class="text-success fs-1">✓</span>' : '' !!}
                                    </td>
                                    <td>
                                        {!! $course->year_work_status ? '<span class="text-success fw-bold">✓</span>' : '' !!}
                                    </td>
                                    <td>
                                        {!! $course->model_answers_status ? '<span class="text-success fw-bold">✓</span>' : '' !!}
                                    </td>
                                    <td class="table-secondary">
                                        {{ $course->incomplete_students }}
                                    </td>
                                    <td class="table-secondary">
                                        {{ $course->withdraw_students }}
                                    </td>
                                    <td class="table-info">
                                        {{ $course->total_absent_students }}
                                    </td>
                                    <td class="table-warning">
                                        {{ $course->total_present_students }}
                                    </td>
                                    <td class="table-warning">
                                        {{ $course->total_deprived_students }}
                                    </td>
                                    <td class="table-success">
                                        {{ $course->cheating_students }}
                                    </td>
                                    <td class="table-success">
                                        {{ $course->misconduct_students }}
                                    </td>
                                    <td>
                                        <div @class([
                                            'badge',
                                            'bg-success' => $course->correction_status == 'completed',
                                            'bg-danger' => $course->correction_status == 'not_started',
                                            'bg-warning' => $course->correction_status == 'in_progress',
                                            'text-white' => $course->correction_status !== 'in_progress',
                                        ])>
                                            {{ $course->correction_status }}
                                        </div>
                                    </td>
                                    <td>
                                        <div @class([
                                            'badge',
                                            'bg-success' => $course->review_status == 'completed',
                                            'bg-danger' => $course->review_status == 'not_started',
                                            'bg-warning' => $course->review_status == 'in_progress',
                                            'text-white' => $course->review_status !== 'in_progress',
                                        ])>
                                            {{ $course->review_status }}
                                        </div>
                                    </td>
                                    <td>
                                        <div @class([
                                            'badge',
                                            'bg-success' => $course->final_grades_status == 'completed',
                                            'bg-danger' => $course->final_grades_status == 'not_started',
                                            'text-white' => $course->final_grades_status !== 'in_progress',
                                            'bg-warning' => $course->final_grades_status == 'in_progress',
                                        ])>
                                            {{ $course->final_grades_status }}
                                        </div>
                                    </td>
                                    <td>
                                        <div @class([
                                            'badge',
                                            'bg-success' => $course->final_grades_review_status == 'completed',
                                            'bg-danger' => $course->final_grades_review_status == 'not_started',
                                            'text-white' => $course->final_grades_review_status !== 'in_progress',
                                            'bg-warning' => $course->final_grades_review_status == 'in_progress',
                                        ])>
                                            {{ $course->final_grades_review_status }}
                                    </td>
                                    <td>
                                        {{ $course->notes }}
                                    </td>
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


