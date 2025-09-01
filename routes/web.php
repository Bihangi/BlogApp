<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AdminLogin;
use App\Livewire\UserLogin;
use App\Http\Controllers\LogoutController;

// Default home
Route::get('/', function () {
    return view('welcome');
});

// Jetstream default user dashboard
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// =======================
// Admin Routes
// =======================

// Admin login page
Route::get('/admin/login', AdminLogin::class)->name('admin.login');

// Admin dashboard (protected by AdminMiddleware)
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');   // make sure this view exists
    })->name('admin.dashboard');
});

// =======================
// User Routes
// =======================
Route::get('/user/login', UserLogin::class)->name('user.login');

// Logout
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
