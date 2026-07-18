<?php

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
| Patient Routes
|--------------------------------------------------------------------------
*/

Route::post('/patient/register', [
    PatientAuthController::class,
    'register'
]);

Route::post('/patient/login', [
    PatientAuthController::class,
    'login'
]);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::post('/admin/login', [
    AdminAuthController::class,
    'login'
]);

/*
|--------------------------------------------------------------------------
| Doctor Routes
|--------------------------------------------------------------------------
*/

Route::post('/doctor/login', [
    DoctorAuthController::class,
    'login'
]);

/*
|--------------------------------------------------------------------------
| Protected Routes (Sanctum)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    /* ============== Patient ============== */

    Route::get('/patient/profile', [
        PatientAuthController::class,
        'profile'
    ]);

    Route::post('/patient/logout', [
        PatientAuthController::class,
        'logout'
    ]);

    /* =============== Admin =============== */

    Route::get('/admin/profile', [
        AdminAuthController::class,
        'profile'
    ]);

    Route::post('/admin/logout', [
        AdminAuthController::class,
        'logout'
    ]);

    /* =============== Doctor ============== */

    Route::get('/doctor/profile', [
        DoctorAuthController::class,
        'profile'
    ]);

    Route::post('/doctor/logout', [
        DoctorAuthController::class,
        'logout'
    ]);
});