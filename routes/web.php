<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthSyncController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HALAMAN UTAMA (Landing Page / Welcome)
// Ini yang muncul pertama kali saat web di-run 
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// 2. DASHBOARD (Wajib Login & Verified)
// Setelah login, user akan dilempar ke sini
Route::get('/dashboard', [HealthSyncController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 3. FITUR PROFILE (Middleware Auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Route untuk Fitur Energy Flow (Store, Update & Delete)
Route::middleware('auth')->group(function () {
    Route::post('/energy/store', [HealthSyncController::class, 'store'])->name('energy.store');
    Route::patch('/energy/update/{id}', [HealthSyncController::class, 'update'])->name('energy.update');
    Route::delete('/energy/delete/{id}', [HealthSyncController::class, 'destroy'])->name('energy.destroy');
});

// 5. Route untuk Academic Stats & Data Maintenance
Route::middleware('auth')->group(function () {
    Route::post('/academic/store', [HealthSyncController::class, 'storeAcademic'])->name('academic.store');
    Route::get('/academic/data', [HealthSyncController::class, 'getAcademicData'])->name('academic.data');
    Route::post('/system/force-recap', [HealthSyncController::class, 'forceRecap'])->name('system.recap');
});

// 6. About (public)
Route::get('/about', function () {
    return view('sync-features.about');
});

// 7. SISTEM AUTH (Login, Register, Logout, dll)
require __DIR__.'/auth.php';