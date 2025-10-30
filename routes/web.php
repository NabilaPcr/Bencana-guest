<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KejadianController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth', [AuthController::class, 'index']);

Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/formLogin', [AuthController::class, 'index']);
Route::get('/berhasil', function () {
    return view('berhasil');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
-> name('guest.dashboard');

//UNTUK KEJADIAN
Route::get('/kejadian', [KejadianController::class, 'index'])
-> name('kejadian.index');

Route::get('/kejadian/create', [KejadianController::class, 'create'])
->name('kejadian.create');

Route::post('/kejadian', [KejadianController::class, 'store'])
->name('kejadian.store');

Route::get('/kejadian/{id}', [KejadianController::class, 'show'])
-> name('kejadian.show');

Route::get('/kejadian/{id}/edit', [KejadianController::class, 'edit'])->name('kejadian.edit');

Route::put('/kejadian/{id}', [KejadianController::class, 'update'])->name('kejadian.update');

Route::delete('/kejadian/{id}', [KejadianController::class, 'destroy'])->name('kejadian.destroy');

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

//route users



// User Routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


