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

// Route untuk Fitur Energy Flow (Update & Delete)
Route::middleware('auth')->group(function () {
    // Route untuk simpan jadwal baru
    Route::post('/energy/store', [HealthSyncController::class, 'store'])->name('energy.store');
    
    // Route yang sudah ada sebelumnya
    Route::patch('/energy/update/{id}', [HealthSyncController::class, 'update'])->name('energy.update');
    Route::delete('/energy/delete/{id}', [HealthSyncController::class, 'destroy'])->name('energy.destroy');
});

Route::get('/about', function () {
    return view('sync-features.about');
});

// 4. SISTEM AUTH (Login, Register, Logout, dll)
require __DIR__.'/auth.php';