<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {        
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);

        if ($user) {
            $user->markEmailAsVerified();
            $status = true;
            $message = 'User created successfully';
        } else {
            $status = false;
            $message = 'User creation failed';
        }
        return to_route('admin.users.index')->with(compact('status', 'message'));

    }

    public function edit(User $user)
    {
        $roles = User::pluck('role')->unique()->values()->toArray();
        return view('admin.users.edit', compact('user', 'roles'));
    }
    

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        if ($user) {
            $status = true;
            $message = 'User updated successfully';
        } else {
            $status = false;
            $message = 'User update failed';
        }
        return to_route('admin.users.index')->with(compact('status', 'message'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        if ($user) {
            $status = true;
            $message = 'User deleted successfully';
        } else {
            $status = false;
            $message = 'User deletion failed';
        }
        return to_route('admin.users.index')->with(compact('status', 'message'));
    }
    
}
