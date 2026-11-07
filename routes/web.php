<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PenggunaController;
use App\Http\Middleware\NoStoreHeaders;
use Illuminate\Support\Facades\Route;


// ==========================
// ROUTE LOGIN
// ==========================
Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'authenticate'])
        ->name('login.attempt');

});


// ==========================
// ROUTE PENGGUNA LOGIN
// ==========================
Route::middleware([NoStoreHeaders::class, 'auth'])->group(function () {

    // Halaman awal
    Route::get('/', fn () => redirect()->route('dashboard'));

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
		
	// HALAMAN UJI AKSES DITOLAK (403)
	Route::get('/akses-ditolak', function () {
		abort(403);
	});

    // Data Mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])
        ->name('mahasiswa.index');

    // Data Mata Kuliah
    Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])
        ->name('matakuliah.index');

    // Data KRS
    Route::get('/krs', [KrsController::class, 'index'])
        ->name('krs.index');

    // Beranda
    Route::get('/beranda', [BerandaController::class, 'index'])
        ->name('beranda');


    // ==========================
    // DATA DOSEN (JOBSHEET 11)
    // ==========================

    // 1. Endpoint JSON DataTables Server-Side
    Route::get('/dosen/data', [DosenController::class, 'data'])
        ->name('dosen.data');

    // 2. Tambah, ubah, dan hapus dosen khusus admin
    Route::middleware('role:admin')->group(function () {

        Route::resource('dosen', DosenController::class)
            ->except(['index', 'show']);

    });

    // 3. Daftar dan detail dosen untuk semua pengguna login
    Route::resource('dosen', DosenController::class)
        ->only(['index', 'show']);


    // ==========================
    // DATA PENGGUNA
    // ==========================
    Route::get('/pengguna', [PenggunaController::class, 'index'])
        ->middleware('role:admin')
        ->name('pengguna.index');

});