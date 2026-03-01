<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\GameController as AdminGameController;
use App\Http\Controllers\Api\Admin\PageController as AdminPageController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{slug}', [GameController::class, 'show']);
Route::get('/pages/{slug}', [PageController::class, 'show']);

// Auth
Route::post('/admin/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/admin/logout', [AuthController::class, 'logout']);
    Route::get('/admin/me', [AuthController::class, 'me']);

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'stats']);
        Route::apiResource('/games', AdminGameController::class);
        Route::get('/pages', [AdminPageController::class, 'index']);
        Route::get('/pages/{page}', [AdminPageController::class, 'show']);
        Route::put('/pages/{page}', [AdminPageController::class, 'update']);
    });
});