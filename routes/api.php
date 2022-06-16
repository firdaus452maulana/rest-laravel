<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EmailVerificationController;
use App\Http\Controllers\API\MahasiswaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('email/verification-notification', [EmailVerificationController::class,'sendVerificationEmail']);
    Route::post('verify-email/{id}/{hash}', [EmailVerificationController::class,'verify'])->name('verification.verify');
    Route::middleware('verified')->group(function () {
        Route::get('mahasiswa', [MahasiswaController::class, 'index']);
        Route::get('mahasiswa/show/{id}', [MahasiswaController::class, 'show']);
        Route::post('mahasiswa/store', [MahasiswaController::class, 'store']);
        Route::post('mahasiswa/update/{id}', [MahasiswaController::class, 'update']);
        Route::get('mahasiswa/destroy/{id}', [MahasiswaController::class, 'destroy']);
    });
});

