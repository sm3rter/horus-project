<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Level;
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

        view()->share('nonReadCheckedReports', Course::where('created_at', '=<', now()->subWeek())->get());
        
        view()->share('levels', Level::with('courses')->get());
    }
}
