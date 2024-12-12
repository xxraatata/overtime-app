<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\NotifikasiController;

Route::get('/dashboard', function () {
    return view('Dashboard');
})->name('Dashboard');
Route::resource('/karyawan', \App\Http\Controllers\KaryawanController::class);
Route::resource('/jabatan', \App\Http\Controllers\JabatanController::class);
Route::resource('/pengajuan', \App\Http\Controllers\TransaksiPengajuanController::class);
Route::resource('/notifikasi', \App\Http\Controllers\NotifikasiController::class);

