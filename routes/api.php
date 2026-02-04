<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KomoditasController;
use App\Http\Controllers\KetersediaanHarianController;

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

    // Ketersediaan Harian
    Route::get('/ketersediaan', [KetersediaanHarianController::class,'index']);
    Route::post('/ketersediaan', [KetersediaanHarianController::class,'store']);
});