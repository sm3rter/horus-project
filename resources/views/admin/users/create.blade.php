@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Add New User</h6>
                <form class="forms-sample" action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" autocomplete="off" placeholder="Name" value="{{ old('name') }}">
                        @error('name')
                            <span class="mb-2 text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group" @error('email') has-danger @enderror>
                        <label for="email">Email address</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <span class="mb-2 text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" autocomplete="off" placeholder="Password" value="{{ old('password') }}">
                        @error('password')
                            <span class="mb-2 text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Select Role</label>
                        <select name="role" class="form-control @error('role') is-invalid @enderror" id="role">
                            <option value="user" selected>User</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role')
                            <span class="mb-2 text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection