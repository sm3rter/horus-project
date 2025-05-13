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
        Route::resource('users', AdminController::class);
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [MainController::class, 'profile'])->name('index');
        Route::put('/update', [MainController::class, 'updateProfile'])->name('update');
    });

    // User Routes
    Route::get('/', [MainController::class, 'index'])->name('home');
    
    // Course Routes
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{level}', [CourseController::class, 'showLevel'])->name('courses.showLevel');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
});


// test route
Route::get('/test', function () {

    $user = User::with('courses')->where('id', 1)->first();

    dd($user->courses->toArray());

});
