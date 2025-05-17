<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {        
        $level = request()->query('level');
        if(is_null($level)) {
            return to_route('home', ['level' => 'level_0']);
        }
        $courses = Course::where('course_level', $level)->whereIsPublished(true)->get();
        return view('home', compact('courses', 'level'));
    }

    public function profile()
    {
        return view('profile', ['user' => auth()->user()]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'password' => 'nullable|string',
        ]);

        $user = auth()->user();
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
