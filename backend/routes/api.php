<?php

use App\Http\Controllers\Api\Admin\SpecialtyController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\DoctorAuthController;
use App\Http\Controllers\Auth\PatientAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

/* ============== Patient ============== */

Route::prefix('patient')->group(function () {

    Route::post('/register', [PatientAuthController::class, 'register']);

    Route::post('/login', [PatientAuthController::class, 'login']);

});

/* =============== Admin =============== */

Route::prefix('admin')->group(function () {

    Route::post('/login', [AdminAuthController::class, 'login']);

});

/* =============== Doctor ============== */

Route::prefix('doctor')->group(function () {

    Route::post('/login', [DoctorAuthController::class, 'login']);

});

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

/* ============== Patient ============== */

Route::prefix('patient')
    ->middleware('auth:sanctum')
    ->group(function () {

        Route::get('/profile', [PatientAuthController::class, 'profile']);

        Route::post('/logout', [PatientAuthController::class, 'logout']);

    });

/* =============== Admin =============== */

Route::prefix('admin')
    ->middleware('auth:sanctum')
    ->group(function () {

        Route::get('/profile', [AdminAuthController::class, 'profile']);

        Route::post('/logout', [AdminAuthController::class, 'logout']);

        Route::apiResource('specialties', SpecialtyController::class);

    });

/* =============== Doctor ============== */

Route::prefix('doctor')
    ->middleware('auth:sanctum')
    ->group(function () {

        Route::get('/profile', [DoctorAuthController::class, 'profile']);

        Route::post('/logout', [DoctorAuthController::class, 'logout']);

    });