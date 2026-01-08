<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\DonasiBencanaController;
use App\Http\Controllers\DistribusiLogistikController;
use App\Http\Controllers\KejadianController;
use App\Http\Controllers\LogistikBencanaController;
use App\Http\Controllers\PoskoController;
use App\Http\Controllers\RegisController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

// ===== ROUTE PUBLIC (TANPA MIDDLEWARE) =====

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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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


// ===== ROUTE YANG BUTUH LOGIN =====
Route::middleware(['checkislogin'])->group(function () {

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

    Route::prefix('logistik')->group(function () {
        Route::get('/', [LogistikBencanaController::class, 'index'])->name('logistik.index');
        Route::get('/create', [LogistikBencanaController::class, 'create'])->name('logistik.create');
        Route::post('/', [LogistikBencanaController::class, 'store'])->name('logistik.store');
        Route::get('/{id}', [LogistikBencanaController::class, 'show'])->name('logistik.show');
        Route::get('/{id}/edit', [LogistikBencanaController::class, 'edit'])->name('logistik.edit');
        Route::put('/{id}', [LogistikBencanaController::class, 'update'])->name('logistik.update');
        Route::delete('/{id}', [LogistikBencanaController::class, 'destroy'])->name('logistik.destroy');
        Route::patch('/{id}/stok', [LogistikBencanaController::class, 'updateStok'])->name('logistik.updateStok');
    });

    // Routes untuk distribusi logistik
    Route::prefix('distribusi')->group(function () {
        Route::get('/', [DistribusiLogistikController::class, 'index'])->name('distribusi.index');
        Route::get('/create', [DistribusiLogistikController::class, 'create'])->name('distribusi.create');
        Route::post('/', [DistribusiLogistikController::class, 'store'])->name('distribusi.store');
        Route::get('/{id}', [DistribusiLogistikController::class, 'show'])->name('distribusi.show');
        Route::get('/{id}/edit', [DistribusiLogistikController::class, 'edit'])->name('distribusi.edit');
        Route::put('/{id}', [DistribusiLogistikController::class, 'update'])->name('distribusi.update');
        Route::delete('/{id}', [DistribusiLogistikController::class, 'destroy'])->name('distribusi.destroy');
    });

// ===== ROUTE HANYA UNTUK SUPER ADMIN =====
   // Route::middleware(['checkislogin', 'checkrole:Super Admin'])->group(function () {

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
 //});
