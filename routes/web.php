<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\logincontroller;
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

    Route::resource('/karyawan', KaryawanController::class);

    Route::get('/user-profil', function () {
        return view('dashboard.user-profil');
    })->name('dashboard');
});
