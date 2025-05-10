<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
    Route::middleware('can:admin')->name('admin.')->group(function () {
        Route::get('/add-new-user', function () {
            return 'Add New User';
        })->name('add-new-user');
    });

    // User Routes
    Route::get('/', [HomeController::class, 'index'])->name('home');
});
