@extends('layouts.app')

@section('content')


<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Levels</li>
            </ol>
        </nav>
    </div>
</div>
@if ($levels->isNotEmpty())
<div class="row">
    @foreach ($levels as $level)
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <ul class="list-group list-group-flush" >
                    <li class="list-group-item d-flex justify-content-between">
                        <div class="">
                            <a href="{{ route('levels.show', ['level' => $level->name]) }}">
                                <p class="display-5 text-dark">{{ ucfirst(str_replace('_', ' ', $level->name)) }}</p>
                            </a>
                        </div>
                        <form action="{{ route('levels.destroy', ['level' => $level->name]) }}" method="POST">
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
    No levels found
</div>
@endif
    
@endsection
