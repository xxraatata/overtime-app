<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaryawanController;

Route::middleware('web')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login')
        ->middleware('guest');
        
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('guest');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout')
        ->middleware('auth');
});

Route::fallback(function () {
    return redirect()->route('login');
});

Route::prefix('admin')->group(function () {
    Route::get('/pengajuan', [AdminController::class, 'dataPengajuan'])->name('admin.pengajuan');
    Route::get('/pengajuan/{id}', [AdminController::class, 'detailPengajuan'])->name('admin.pengajuan.detail');
});

Route::prefix('karyawan')->group(function () {
    Route::get('/pengajuan', [KaryawanController::class, 'riwayat'])->name('karyawan.pengajuan');
    Route::get('/pengajuan/create', [KaryawanController::class, 'create'])->name('karyawan.pengajuan.create');
    Route::get('/pengajuan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.pengajuan.edit');
    Route::get('/pengajuan/{id}', [KaryawanController::class, 'detail'])->name('karyawan.pengajuan.detail');
});
