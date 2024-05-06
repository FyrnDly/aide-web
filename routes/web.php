<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MonitorController;
use Illuminate\Support\Facades\Route;

// Index Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard Admin
Route::get('/admin', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

// Profile Seting
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Resource
require __DIR__.'/auth.php';

// Monitor Resource
Route::prefix('dashboard')->group(function () {
    Route::get('/', [MonitorController::class, 'index'])->name('dashboard.index');
    Route::post('/store', [MonitorController::class, 'store'])->name('dashboard.store');
    Route::post('/update', [MonitorController::class, 'update'])->name('dashboard.update');
    Route::post('/destroy', [MonitorController::class, 'destroy'])->name('dashboard.destroy');
})->middleware(['auth', 'verified']);