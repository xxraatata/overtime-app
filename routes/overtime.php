<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\TransaksiPengajuanController;
use App\Http\Controllers\NotifikasiController;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected Routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('Dashboard');
    })->name('Dashboard');

    // Karyawan Management
    Route::resource('karyawan', KaryawanController::class);
    
    // Jabatan Management
    Route::resource('jabatan', JabatanController::class);
    
    // Pengajuan Overtime
    Route::resource('pengajuan', TransaksiPengajuanController::class);
    
    // Notifikasi
    Route::resource('notifikasi', NotifikasiController::class);
    
    // Additional Pengajuan Routes
    Route::prefix('pengajuan')->group(function () {
        Route::post('/{id}/approve', [TransaksiPengajuanController::class, 'approve'])->name('pengajuan.approve');
        Route::post('/{id}/reject', [TransaksiPengajuanController::class, 'reject'])->name('pengajuan.reject');
    });
});

