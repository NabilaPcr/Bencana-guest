<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/berhasil', function () {
    return view('berhasil');
});


// Route::get('/auth', [AuthController::class, 'index']);
// Route::post('/auth/login', [AuthController::class, 'login']);
// Route::get('/berhasil', function () {
//     return view('berhasil');
// });
