@extends('layouts.app')

@section('content')
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Create New Level</h6>
            <form action="{{ route('levels.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="name" name="name" autocomplete="off" placeholder="Name">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mr-2">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
