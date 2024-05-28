<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\MonitorController;

// Monitor Resource
// Route::prefix('dashboard')->group(function () {
//     Route::get('/', [MonitorController::class, 'index'])->name('dashboard.index');
//     Route::post('/store', [MonitorController::class, 'store'])->name('dashboard.store');
//     Route::post('/update', [MonitorController::class, 'update'])->name('dashboard.update');
//     Route::post('/destroy', [MonitorController::class, 'destroy'])->name('dashboard.destroy');
// });
