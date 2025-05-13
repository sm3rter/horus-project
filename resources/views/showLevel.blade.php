@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ request()->level }}</li>
    </ol>
</nav>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Available Courses for <strong class="text-primary">{{ str_replace('_', ' ', request()->level) }}</strong></h6>
            @if ($courses->isNotEmpty())
                <ul class="list-group list-group-flush" >
                    @foreach ($courses as $course)
                        <li class="list-group-item">
                            <a href="{{ route('courses.show', ['course' => $course->id, 'level' => request()->level]) }}">
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


