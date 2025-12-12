<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KejadianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PoskoController;
use App\Http\Controllers\DonasiBencanaController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DeveloperController;





Route::get('/', function () {
    return view('guest.dashboard');
});


Route::get('/auth', [AuthController::class, 'index']);

Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/formLogin', [AuthController::class, 'index']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [RegisController::class, 'index'])->name('register');
Route::post('/auth/register', [RegisController::class, 'store']);



Route::get('/dashboard', [DashboardController::class, 'index'])
-> name('guest.dashboard');

//UNTUK KEJADIAN
Route::get('/kejadian', [KejadianController::class, 'index'])-> name('kejadian.index');
Route::get('/kejadian/create', [KejadianController::class, 'create'])->name('kejadian.create');
Route::post('/kejadian', [KejadianController::class, 'store'])->name('kejadian.store');
Route::get('/kejadian/{id}', [KejadianController::class, 'show'])-> name('kejadian.show');
Route::get('/kejadian/{id}/edit', [KejadianController::class, 'edit'])->name('kejadian.edit');
Route::put('/kejadian/{id}', [KejadianController::class, 'update'])->name('kejadian.update');
Route::delete('/kejadian/{id}', [KejadianController::class, 'destroy'])->name('kejadian.destroy');
Route::delete('/kejadian/hapus-foto/{id}', [KejadianController::class, 'destroyFile'])->name('kejadian.destroyFile');

// Routes untuk Warga
Route::prefix('warga')->group(function () {
    Route::get('/create', [WargaController::class, 'create'])->name('warga.create');
    Route::post('/store', [WargaController::class, 'store'])->name('warga.store');
    Route::get('/', [WargaController::class, 'index'])->name('warga.index');
    Route::get('/{id}', [WargaController::class, 'show'])->name('warga.show');
    Route::get('/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
    Route::put('/{id}', [WargaController::class, 'update'])->name('warga.update');
    Route::delete('/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');
});



// User Routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

//ROUTE POSKO
Route::get('/posko', [PoskoController::class, 'index'])->name('posko.index');
Route::get('/posko/create', [PoskoController::class, 'create'])->name('posko.create');
Route::post('/posko', [PoskoController::class, 'store'])->name('posko.store');
Route::get('/posko/{id}', [PoskoController::class, 'show'])->name('posko.show');
Route::get('/posko/{id}/edit', [PoskoController::class, 'edit'])->name('posko.edit');
Route::put('/posko/{id}', [PoskoController::class, 'update'])->name('posko.update');
Route::delete('/posko/{id}', [PoskoController::class, 'destroy'])->name('posko.destroy');



// ROUTE DONASI - Pastikan seperti ini:
Route::get('/donasi', [DonasiBencanaController::class, 'index'])->name('donasi.index');
Route::get('/donasi/create', [DonasiBencanaController::class, 'create'])->name('donasi.create');
Route::post('/donasi', [DonasiBencanaController::class, 'store'])->name('donasi.store');
Route::get('/donasi/{id}', [DonasiBencanaController::class, 'show'])->name('donasi.show');
Route::get('/donasi/{id}/edit', [DonasiBencanaController::class, 'edit'])->name('donasi.edit');
Route::put('/donasi/{id}', [DonasiBencanaController::class, 'update'])->name('donasi.update');
Route::delete('/donasi/{id}', [DonasiBencanaController::class, 'destroy'])->name('donasi.destroy');

//ROUTE LOGISTIIK


//ROUTE DISTRIBUSI

//ROUTE ABOUT:
Route::get('/tentang', [AboutController::class, 'index'])->name('about');


Route::get('/developer', [DeveloperController::class, 'show'])->name('developer.show');
