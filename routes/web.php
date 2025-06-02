<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('jadwal', JadwalController::class);
    Route::get('/dashboard', [JadwalController::class, 'dashboard'])->name('dashboard');
});

Route::middleware(IsAdmin::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('manage-users', UsersController::class)->except(['show']);
});

require __DIR__.'/auth.php';
