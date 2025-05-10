<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'password' => 'nullable|string',
        ]);

        $user = User::find(auth()->user()->id);
        $user->password = bcrypt($request->input('password'));
        $user->save();
        if ($user) {
            $status = true;
            $message = 'Profile updated successfully';
        } else {
            $status = false;
            $message = 'Profile update failed';
        }
        return to_route('profile.index')->with(compact('status', 'message'));
    }
    
}
