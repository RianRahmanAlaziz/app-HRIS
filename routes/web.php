<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisCutiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\UikaryawanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    })->name('login');
});

Route::controller(Logincontroller::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});




Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::post('/absensi/get-location', [AbsensiController::class, 'location']);
    // Admin
    Route::middleware(['role:Admin|HRD'])->prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        // data master
        Route::resource('/data-user-management', UserController::class);
        Route::resource('/data-pegawai', KaryawanController::class);
        Route::resource('/data-jabatan', JabatanController::class);
        Route::resource('/data-jenis-cuti', JenisCutiController::class);
        Route::get('/list-pengajuan-cuti', [DashboardController::class, 'listpengajuan']);
        Route::post('/list-pengajuan-cuti/{status}', [DashboardController::class, 'ubah_status']);
        Route::controller(AbsensiController::class)->group(function () {
            // Laporan
            Route::get('/laporan/laporan-absensi', 'laporan');
            Route::post('/laporan/laporan-absensi', 'laporan');
        });
        Route::get('/user-profil', [UserController::class, 'userprofil']);
    });

    // Karyawan
    Route::middleware(['role:Karyawan'])->group(function () {

        Route::controller(UikaryawanController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/user-profil', 'userprofil');
            Route::post('//user-profil/{id}/update', 'edituserprofil');
            Route::get('/histori-absensi', 'history');
        });

        Route::controller(AbsensiController::class)->group(function () {
            Route::get('/absensi', 'index');
            Route::post('/absensi/{id}', 'store');
            Route::put('/absensi/{id}', 'update');
            // Laporan
            Route::get('/laporan/laporan-absensi', 'laporan');
            Route::post('/laporan/laporan-absensi', 'laporan');
        });

        Route::resource('/pengajuan-cuti', PengajuanCutiController::class);
    });

    Route::middleware(['auth'])->group(function () {

        Route::get('/riwayat-pengajuan-cuti', [DashboardController::class, 'riwayatpengajuan']);
    });

    Route::get('/unduh/{nama_file}', [PengajuanCutiController::class, 'unduh'])->name('unduh');
});
