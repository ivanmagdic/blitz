<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'create'])->name('login');
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'store'])->name('login.submit');
    Route::get('register', [\App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
    Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('home', function () {
        return \Inertia\Inertia::render('Dashboard', [
            'user' => auth()->user()
        ]);
    })->name('dashboard');

    Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'destroy'])->name('logout');
});
