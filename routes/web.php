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

// ===== ROUTE PUBLIC (TANPA MIDDLEWARE) =====
// Halaman utama guest
Route::get('/', function () {
    return view('guest.dashboard');
});

// Halaman LOGIN - HARUS TANPA MIDDLEWARE
Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

// Halaman REGISTER - HARUS TANPA MIDDLEWARE
Route::get('/register', [RegisController::class, 'index'])->name('register');
Route::post('/auth/register', [RegisController::class, 'store'])->name('auth.register');

// Halaman ABOUT & DEVELOPER - public
Route::get('/tentang', [AboutController::class, 'index'])->name('about');
Route::get('/developer', [DeveloperController::class, 'show'])->name('developer.show');

// ===== ROUTE LOGOUT =====
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// ===== ROUTE YANG BUTUH LOGIN =====
 Route::middleware(['checkislogin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // KEJADIAN
    Route::prefix('kejadian')->group(function () {
        Route::get('/', [KejadianController::class, 'index'])->name('kejadian.index');
        Route::get('/create', [KejadianController::class, 'create'])->name('kejadian.create');
        Route::post('/', [KejadianController::class, 'store'])->name('kejadian.store');
        Route::get('/{id}', [KejadianController::class, 'show'])->name('kejadian.show');
        Route::get('/{id}/edit', [KejadianController::class, 'edit'])->name('kejadian.edit');
        Route::put('/{id}', [KejadianController::class, 'update'])->name('kejadian.update');
        Route::delete('/{id}', [KejadianController::class, 'destroy'])->name('kejadian.destroy');
        Route::delete('/hapus-foto/{id}', [KejadianController::class, 'destroyFile'])->name('kejadian.destroyFile');
    });

    // WARGA
    Route::prefix('warga')->group(function () {
        Route::get('/create', [WargaController::class, 'create'])->name('warga.create');
        Route::post('/store', [WargaController::class, 'store'])->name('warga.store');
        Route::get('/', [WargaController::class, 'index'])->name('warga.index');
        Route::get('/{id}', [WargaController::class, 'show'])->name('warga.show');
        Route::get('/{id}/edit', [WargaController::class, 'edit'])->name('warga.edit');
        Route::put('/{id}', [WargaController::class, 'update'])->name('warga.update');
        Route::delete('/{id}', [WargaController::class, 'destroy'])->name('warga.destroy');
    });

    // POSKO
    Route::prefix('posko')->group(function () {
        Route::get('/', [PoskoController::class, 'index'])->name('posko.index');
        Route::get('/create', [PoskoController::class, 'create'])->name('posko.create');
        Route::post('/', [PoskoController::class, 'store'])->name('posko.store');
        Route::get('/{id}', [PoskoController::class, 'show'])->name('posko.show');
        Route::get('/{id}/edit', [PoskoController::class, 'edit'])->name('posko.edit');
        Route::put('/{id}', [PoskoController::class, 'update'])->name('posko.update');
        Route::delete('/{id}', [PoskoController::class, 'destroy'])->name('posko.destroy');
    });

    // DONASI
    Route::prefix('donasi')->group(function () {
        Route::get('/', [DonasiBencanaController::class, 'index'])->name('donasi.index');
        Route::get('/create', [DonasiBencanaController::class, 'create'])->name('donasi.create');
        Route::post('/', [DonasiBencanaController::class, 'store'])->name('donasi.store');
        Route::get('/{id}', [DonasiBencanaController::class, 'show'])->name('donasi.show');
        Route::get('/{id}/edit', [DonasiBencanaController::class, 'edit'])->name('donasi.edit');
        Route::put('/{id}', [DonasiBencanaController::class, 'update'])->name('donasi.update');
        Route::delete('/{id}', [DonasiBencanaController::class, 'destroy'])->name('donasi.destroy');
    });
 //});

// ===== ROUTE HANYA UNTUK SUPER ADMIN =====
 Route::middleware(['checkislogin', 'checkrole:Super Admin'])->group(function () {
    // USER MANAGEMENT - hanya untuk Super Admin
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
 });
 });
