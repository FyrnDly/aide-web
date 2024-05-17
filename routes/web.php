<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Index Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Profile Seting
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Resource
require __DIR__.'/auth.php';

// Monitor Resource
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [MonitorController::class, 'index'])->name('dashboard.index');
    Route::post('/store', [MonitorController::class, 'store'])->name('dashboard.store')->middleware('admin');
    Route::post('/update', [MonitorController::class, 'update'])->name('dashboard.update')->middleware('admin');
    Route::post('/destroy', [MonitorController::class, 'destroy'])->name('dashboard.destroy')->middleware('admin');
});

// Admin Controller
Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
});