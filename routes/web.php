<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
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
});
