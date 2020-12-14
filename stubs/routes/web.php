<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.submit');
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('home', function () {
        return \Inertia\Inertia::render('Dashboard', [
            'user' => auth()->user()
        ]);
    })->name('dashboard');

    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

    // Email verification
    Route::get('verify-email',
        [EmailVerificationController::class, 'show'])->name('verification.notice');
    Route::post('verify-email',
        [EmailVerificationController::class, 'store'])->name('verification.store');
    Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
});
