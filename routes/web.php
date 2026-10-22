<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NapiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KunjunganController;

// ================= RUTE PUBLIK (BELUM LOGIN / UMUM) =================

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

// Papan Antrian diletakkan di luar auth agar Smart TV tidak perlu login
Route::get('/papan-antrian', [KunjunganController::class, 'papanAntrian']);

// Rute untuk pendaftaran online mandiri oleh keluarga napi
Route::get('/daftar-jenguk', [App\Http\Controllers\KunjunganController::class, 'formOnline']);
Route::post('/daftar-jenguk/simpan', [App\Http\Controllers\KunjunganController::class, 'simpanOnline']);


// ================= RUTE TERKUNCI (HARUS LOGIN KHUSUS PETUGAS) =================

Route::middleware('auth')->group(function () {
    
    // Rute Logout & Dashboard
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/', [NapiController::class, 'dashboard']);

    // Rute CRUD Napi
    Route::get('/data-napi', [NapiController::class, 'index']);
    Route::get('/tambah-napi', [NapiController::class, 'create']);
    Route::post('/simpan-napi', [NapiController::class, 'store']);
    Route::get('/detail-napi/{id}', [NapiController::class, 'show']);
    Route::get('/edit-napi/{id}', [NapiController::class, 'edit']);
    Route::put('/update-napi/{id}', [NapiController::class, 'update']);
    Route::delete('/hapus-napi/{id}', [NapiController::class, 'destroy']);

    // Rute Manajemen Pengguna (Khusus Superadmin)
    Route::get('/manajemen-pengguna', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/tambah-pengguna', [App\Http\Controllers\UserController::class, 'create']);
    Route::post('/simpan-pengguna', [App\Http\Controllers\UserController::class, 'store']);
    Route::get('/edit-pengguna/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::put('/update-pengguna/{id}', [App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/hapus-pengguna/{id}', [App\Http\Controllers\UserController::class, 'destroy']);

    // Rute Cetak Jurnal Harian & Remisi
    Route::get('/jurnal-harian', [NapiController::class, 'jurnalHarian']);
    Route::post('/tambah-remisi/{napi_id}', [App\Http\Controllers\RemisiController::class, 'store']);
    Route::post('/proses-bebas/{id}', [App\Http\Controllers\NapiController::class, 'prosesBebas']);

    // Fitur Manajemen Kunjungan (Hanya petugas yang bisa mendata dan memanggil antrian)
    Route::get('/loket-kunjungan', [KunjunganController::class, 'loket']);
    Route::post('/tambah-antrian', [KunjunganController::class, 'store']);
    Route::get('/update-antrian/{id}/{status}', [KunjunganController::class, 'updateStatus']);

    // Halaman Riwayat Kunjungan
    Route::get('/riwayat-kunjungan', [KunjunganController::class, 'riwayat']);


});