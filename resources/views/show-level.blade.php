@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ ucfirst(str_replace('_', ' ', request()->level)) }}</li>
    </ol>
</nav>
@if ($courses->isNotEmpty())
<div class="row">
    @foreach ($courses as $course)
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <ul class="list-group list-group-flush" >
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="">
                            <a href="{{ route('courses.show', ['course' => $course->id, 'level' => request()->level]) }}">
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