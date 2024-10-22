<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuccessfulEmailController;
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
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/successful-emails', [SuccessfulEmailController::class, 'store']);
    Route::get('/successful-emails/{id}', [SuccessfulEmailController::class, 'show']);
    Route::put('/successful-emails/{id}', [SuccessfulEmailController::class, 'update']);
    Route::get('/successful-emails', [SuccessfulEmailController::class, 'index']);
    Route::delete('/successful-emails/{id}', [SuccessfulEmailController::class, 'destroy']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
