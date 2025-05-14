<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships();
        
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });

        Blade::if('admin', function () {
            return Auth::check() && Auth::user()->role === 'admin';
        });

        view()->composer('layouts.app', function ($view) {
            if(auth()->user()->isAdmin()) {
                $courses = Course::orderBy('course_level')->pluck('course_level')->toArray();
            } else {
                $courses = auth()->user()->courses->orderBy('course_level')->pluck('course_level')->toArray();
            }
            $view->with('professorAvailableCourses', array_unique($courses));
        });

        Gate::define('update-course', function (User $user, int $course) {
            $course = Course::findOrFail($course);
            return $user->isAdmin() || $user->courses->contains($course);
        });
        
    }
}
