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

        Blade::if('isLinkActive', function ($route_name) {
            return request()->routeIs($route_name) ? true : false;
        });

        view()->composer('layouts.app', function ($view) {
            $view->with('professorAvailableCourses', array_unique(auth()->user()->courses->pluck('course_level')->toArray()));
        });
    }
}
