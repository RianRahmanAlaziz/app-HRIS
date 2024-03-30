<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisCutiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\PengajuanCutiController;
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

Route::get('/', function () {
    return view('login', [
        'title' => 'Login'
    ]);
})->name('login');


Route::controller(Logincontroller::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});


Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // data master
    Route::resource('/data-user-management', UserController::class);
    Route::resource('/data-pegawai', KaryawanController::class);
    Route::resource('/data-jabatan', JabatanController::class);
    Route::resource('/data-jenis-cuti', JenisCutiController::class);
    Route::resource('/pengajuan-cuti', PengajuanCutiController::class);

    Route::get('/list-pengajuan-cuti', [DashboardController::class, 'listpengajuan']);
    Route::get('/riwayat-pengajuan-cuti', [DashboardController::class, 'riwayatpengajuan']);
    Route::post('/list-pengajuan-cuti/{status}', [DashboardController::class, 'ubah_status']);



    Route::get('/user-profil', [UserController::class, 'userprofil']);

    Route::get('/unduh/{nama_file}', [PengajuanCutiController::class, 'unduh'])->name('unduh');
});
