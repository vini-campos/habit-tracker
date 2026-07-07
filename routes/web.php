<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// GUEST
Route::middleware('guest')->group(function ()
{
    // SITE{index}
    Route::get('/', [SiteController::class, 'index'])->name('site.index');

    // LOGIN
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');

    // REGISTER
    Route::get('/cadastro', [RegisterController::class, 'index'])->name('site.register');
    // store e usado como nomenclatura quando vai salvar algo, como o usuario no banco
    Route::post('/cadastro', [RegisterController::class, 'store'])->name('auth.register');
});

// AUTH
Route::middleware('auth')->group(function ()
{
    // LOGOUT
    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

    // HABITS
    Route::get('/dashboard/habits/history/{year?}', [HabitController::class, 'history'])->name('habits.history');
    Route::get('/dashboard/habits/config', [HabitController::class, 'settings'])->name('habits.settings');
    Route::post('/dashboard/habits/{habit}/toggle', [HabitController::class, 'toggle'])->name('habits.toggle');
    Route::get('/dashboard/habits/calendar', [HabitController::class, 'calendar'])->name('habits.calendar');
    Route::resource('/dashboard/habits', HabitController::class)->except('show');
});
