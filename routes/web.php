<?php


use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;

Route::permanentRedirect('/authentication', '/authentication/login');

// Authentication Routes
Route::prefix('authentication')->name('authentication.')->controller(AuthController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'showLoginForm')->name('showLoginForm');
        Route::post('/login', 'login')->name('login');
    });
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    // Admin Routes
    Route::middleware('can:admin')->name('admin.')->prefix('admin')->group(function () {
        Route::get('/add-new-user', [AdminController::class, 'create'])->name('add-new-user');
        Route::resource('users', AdminController::class)->except('show');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [MainController::class, 'profile'])->name('index');
        Route::put('/update', [MainController::class, 'updateProfile'])->name('update');
    });

    // User Routes
    Route::get('/', [MainController::class, 'index'])->name('home');

    // Level Routes
    Route::prefix('levels/{level}')->group(function () {
        Route::get('/', [CourseController::class, 'showLevel'])->name('levels.showLevel');
        Route::resource('courses', CourseController::class)->only(['update', 'show']);
    });
    Route::resource('courses', CourseController::class)->only(['store', 'create']);

});

