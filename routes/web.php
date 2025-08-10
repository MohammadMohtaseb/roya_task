<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminSeriesController;
use App\Http\Controllers\Admin\AdminEpisodeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
    Route::get('/series/{series}', [SeriesController::class, 'show'])->name('series.show');
    Route::post('/series/{series}/follow', [SeriesController::class, 'follow'])->name('series.follow');
    Route::delete('/series/{series}/unfollow', [SeriesController::class, 'unfollow'])->name('series.unfollow');
    
    Route::get('/episodes/{episode}', [EpisodeController::class, 'show'])->name('episodes.show');
    Route::post('/episodes/{episode}/like', [EpisodeController::class, 'like'])->name('episodes.like');
    Route::post('/episodes/{episode}/dislike', [EpisodeController::class, 'dislike'])->name('episodes.dislike');
    
    Route::get('/search', [SeriesController::class, 'search'])->name('search');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    
    Route::resource('series', AdminSeriesController::class);
    Route::resource('episodes', AdminEpisodeController::class);
});
