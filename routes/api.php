<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HargaPasarHarianController;
use App\Http\Controllers\HargaPetaniHarianController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KomoditasController;
use App\Http\Controllers\KetersediaanHarianController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\PasarController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // Authentication
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    // Komoditas
    Route::get('/komoditas', [KomoditasController::class,'index']);
    Route::post('/komoditas', [KomoditasController::class,'store']);

    // Pasar
    Route::get('/pasar', [PasarController::class, 'index']);
    Route::post('/pasar', [PasarController::class, 'store']);

    // Ketersediaan Harian
    Route::get('/ketersediaan', [KetersediaanHarianController::class,'index']);
    Route::post('/ketersediaan', [KetersediaanHarianController::class,'store']);

    // Panen
    Route::get('/panen', [PanenController::class, 'index']);
    Route::post('/panen', [PanenController::class, 'store']);

    // Harga Pasar Harian
    Route::get('/harga-pasar', [HargaPasarHarianController::class, 'index']);
    Route::post('/harga-pasar', [HargaPasarHarianController::class, 'store']);

    // Harga Penati Harian
    Route::get('/harga-petani', [HargaPetaniHarianController::class, 'index']);
    Route::post('/harga-petani', [HargaPetaniHarianController::class, 'store']);
});