<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// SITE
// name e opcional, serve para nao ter que trocar de todas as funcoes e do html que utiliza a rota
Route::get('/', [SiteController::class, 'index'])->name('site.index');

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('site.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');

// AUTH
Route::middleware('auth')->group(function () {
    // DASHBOARD
    Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('site.dashboard');

    // LOGOUT
    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
});

