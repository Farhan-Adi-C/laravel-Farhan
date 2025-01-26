<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiDataController;
use App\Http\Controllers\Api\ApiHobbyController;
use App\Http\Controllers\Api\ApiPhoneController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('siswa', ApiDataController::class);
    Route::apiResource('phone', ApiPhoneController::class);
    Route::apiResource('hobby', ApiHobbyController::class);
});

Route::post('registerUser', [ApiAuthController::class, 'registerUser']);
Route::post('loginUser', [ApiAuthController::class, 'loginUser']);

Route::get('/', function(){
    return response()->json([
        'status' => false,
        'message' => 'akses tidak diperbolehkan',

    ], 401);
})->name('login');