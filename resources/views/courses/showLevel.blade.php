@extends('layouts.app')

@section('content')
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Your Courses for Level {{ request()->level }}</h6>
            @if ($courses->isNotEmpty())
                <ul class="list-group list-group-flush" >
                    @foreach ($courses as $course)
                        <li class="list-group-item">
                            <a href="{{ route('courses.show', $course->id) }}">
                                {{ $course->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="alert alert-secondary text-center" role="alert">
                    No courses found
                </div>
            @endif
        </div>
    </div>
</div>
@endsection


