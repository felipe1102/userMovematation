<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserMovementController;
use App\Http\Controllers\SesionController;

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

Route::prefix('v1')->group(function () {
    Route::post("/login", [SesionController::class, 'login']);


    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post("/logoff", [SesionController::class, 'logoff']);


        Route::prefix('users')->group(function () {
            Route::post("/", [UserController::class, 'store']);
            Route::get("/", [UserController::class, 'index']);
            Route::get("/{id}", [UserController::class, 'show']);
            Route::put("/{id}", [UserController::class, 'update']);
            Route::delete("/{id}", [UserController::class, 'destroy']);
        });

        Route::prefix('movements')->group(function () {
            Route::get("/", [UserMovementController::class, 'index']);
            Route::post("/", [UserMovementController::class, 'store']);
            Route::put("/{id}/reversal", [UserMovementController::class, 'update']);
            Route::delete("/{id}", [UserMovementController::class, 'destroy']);

            Route::get("/excel", [UserMovementController::class, 'excelMovement']);

        });
    });


});


