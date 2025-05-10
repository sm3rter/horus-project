@extends('layouts.app')

@section('content')
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h6 class="card-title">Edit Profile</h6>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mr-2">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection


