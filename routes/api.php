<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/login', LoginController::class);
    Route::post('/register', UserRegisterController::class);
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/logout', LogoutController::class);
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });
});

