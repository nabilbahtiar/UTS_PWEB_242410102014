<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', fn() => redirect()->route('login'))->name('home');

Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login', [PageController::class, 'handleLogin'])->name('handleLogin');

//Dashboard
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

//Profile
Route::get('/profile', [PageController::class, 'profile'])->name('profile');

// Pengelolaan
Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');