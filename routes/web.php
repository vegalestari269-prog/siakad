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

	// ==========================
	// DATA MAHASISWA (JOBSHEET 12)
	// ==========================

	// 1. Endpoint JSON DataTables Server-Side
	Route::get('/mahasiswa/data', [MahasiswaController::class, 'data'])
		->name('mahasiswa.data');

	// 2. Tambah, ubah, dan hapus mahasiswa khusus admin
	Route::middleware('role:admin')->group(function () {

		Route::resource('mahasiswa', MahasiswaController::class)
			->except(['index', 'show']);

	});

	// 3. Daftar dan detail mahasiswa untuk semua pengguna login
	Route::resource('mahasiswa', MahasiswaController::class)
		->only(['index', 'show']);
		

    // ==========================
	// DATA MATA KULIAH (JOBSHEET 12)
	// ==========================

	// 1. Endpoint JSON DataTables Server-Side
	Route::get('/mata-kuliah/data', [MataKuliahController::class, 'data'])
		->name('matakuliah.data');

	// 2. Tambah, ubah, dan hapus mata kuliah khusus admin
	Route::middleware('role:admin')->group(function () {

		Route::resource('mata-kuliah', MataKuliahController::class)
			->parameters(['mata-kuliah' => 'mataKuliah'])
			->except(['index', 'show'])
			->names([
				'create' => 'matakuliah.create',
				'store' => 'matakuliah.store',
				'edit' => 'matakuliah.edit',
				'update' => 'matakuliah.update',
				'destroy' => 'matakuliah.destroy',
			]);

	});

	// 3. Daftar dan detail mata kuliah untuk semua pengguna login
	Route::resource('mata-kuliah', MataKuliahController::class)
		->parameters(['mata-kuliah' => 'mataKuliah'])
		->only(['index', 'show'])
		->names([
			'index' => 'matakuliah.index',
			'show' => 'matakuliah.show',
		]);

    // Route DataTables KRS
	Route::get('/krs/data', [KrsController::class, 'data'])
		->name('krs.data');

	// Route khusus admin untuk tambah, simpan, edit, update, dan hapus
	Route::middleware('role:admin')->group(function () {

		Route::resource('krs', KrsController::class)
			->except(['index', 'show'])
			->parameters(['krs' => 'kr']);

	});

	// Route untuk menampilkan daftar dan detail KRS
	Route::resource('krs', KrsController::class)
		->only(['index', 'show'])
		->parameters(['krs' => 'kr']);

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