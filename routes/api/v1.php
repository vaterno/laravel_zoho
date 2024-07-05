<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DealController;
use App\Http\Controllers\Api\AccountController;

Route::prefix('accounts')->group(function () {
    Route::get('/', [AccountController::class, 'index']);
    Route::post('/', [AccountController::class, 'store']);
});

Route::prefix('deals')->group(function () {
    Route::get('/', [DealController::class, 'index']);
    Route::post('/', [DealController::class, 'store']);
    Route::get('/stages', [DealController::class, 'getStages']);
});
