<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenaltiesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\ReturnCarController;
use App\Models\Penalties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('a1')->group(function () {
    // route : /api/a1/auth
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
        // sanctum untuk membaca token
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('register', RegisterController::class);
        Route::apiResource('rent', RentController::class);
        Route::apiResource('return', ReturnCarController::class);
        Route::apiResource('penalties', PenaltiesController::class);
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
