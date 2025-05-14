<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $level = request()->query('course_level');

        abort_if(!is_null($level) && !in_array($level, ['level_0', 'level_1', 'level_2', 'level_3', 'level_4']), 404);
        
        $courses = Course::where('course_level', $level)->get();
        
        return view('home', compact('courses', 'level'));
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
