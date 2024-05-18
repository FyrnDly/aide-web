<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\TeamController;
use App\Models\About;
use App\Models\Feature;
use App\Models\Documentation;
use App\Models\Team;
use Illuminate\Support\Facades\Route;

// Index Home
Route::get('/', function () {
    $abouts = About::get();
    $features = Feature::get();
    $documentations = Documentation::get();
    $teams = Team::get();

    return view('welcome',[
        'abouts' => $abouts,
        'features' => $features,
        'documentations' => $documentations,
        'teams' => $teams,
    ]);
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
    Route::post('/update/{id}', [AdminController::class, 'update'])->name('admin.update')->middleware('root');
    // About
    Route::resource('about', AboutController::class)->except([
        'create', 'show'
    ]);
    // Feature
    Route::resource('feature', FeatureController::class)->except([
        'create', 'show'
    ]);
    // Documentation
    Route::resource('documentation', DocumentationController::class)->except([
        'create', 'show'
    ]);
    // Team
    Route::resource('team', TeamController::class)->except([
        'create', 'show'
    ]);
});