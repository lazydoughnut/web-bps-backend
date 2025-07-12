<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublikasiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Publikasi
    Route::get('/publikasi', [PublikasiController::class, 'index']);         // Menampilkan daftar publikasi
    Route::post('/publikasi', [PublikasiController::class, 'store']);        // Menyimpan publikasi baru
    Route::get('/publikasi/{id}', [PublikasiController::class, 'show']);     // Menampilkan detail publikasi
    Route::put('/publikasi/{id}', [PublikasiController::class, 'update']);   // Mengupdate publikasi
    Route::delete('/publikasi/{id}', [PublikasiController::class,'hapus']);  // Menghapus publikasi
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});