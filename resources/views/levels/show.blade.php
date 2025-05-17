@extends('layouts.app')

@section('content')


<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('levels.index') }}">Levels</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ ucfirst(str_replace('_', ' ', $level->name)) }}</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
        <a href="{{ route('courses.create', ['selected_level' => $level->name]) }}" class="btn btn-success btn-icon-text mr-2 mb-2 mb-md-0">
            <i class="btn-icon-prepend" data-feather="plus"></i>
            Add New Course to {{ ucfirst(str_replace('_', ' ', $level->name)) }}
        </a>
    </div>
</div>
@if ($level->courses->isNotEmpty())
<div class="row">
    @foreach ($level->courses as $course)
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <ul class="list-group list-group-flush" >
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="">
                            <a href="{{ route('courses.show', ['course' => $course->id]) }}">
                                <p class="display-5 text-dark">{{ $course->title }}</p>
                            </a>
                        </div>
                        <form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger">Delete</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="alert alert-secondary text-center" role="alert">
    No courses found
</div>
@endif
    
@endsection
