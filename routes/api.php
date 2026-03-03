<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChangelogController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\IdeaController;
use App\Http\Controllers\Api\OauthController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\Admin\ChangelogController as AdminChangelogController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\GameController as AdminGameController;
use App\Http\Controllers\Api\Admin\IdeaController as AdminIdeaController;
use App\Http\Controllers\Api\Admin\PageController as AdminPageController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{slug}', [GameController::class, 'show']);
Route::get('/pages/{slug}', [PageController::class, 'show']);

// Public changelog & ideas
Route::get('/games/{slug}/changelog', [ChangelogController::class, 'index']);
Route::get('/games/{slug}/ideas', [IdeaController::class, 'index']);
Route::get('/games/{slug}/ideas/{idea}', [IdeaController::class, 'show']);

// OAuth token exchange (proxied to avoid CORS)
Route::post('/auth/token', [OauthController::class, 'token']);

// OAuth user routes
Route::middleware('oauth.user')->group(function () {
    Route::post('/games/{slug}/ideas', [IdeaController::class, 'store']);
    Route::post('/ideas/{idea}/vote', [IdeaController::class, 'vote']);
    Route::post('/ideas/{idea}/comments', [IdeaController::class, 'storeComment']);
    Route::delete('/ideas/comments/{comment}', [IdeaController::class, 'destroyComment']);
});

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

        // Changelog admin
        Route::get('/games/{game}/changelog', [AdminChangelogController::class, 'index']);
        Route::post('/games/{game}/changelog', [AdminChangelogController::class, 'store']);
        Route::get('/games/{game}/changelog/{changelog}', [AdminChangelogController::class, 'show']);
        Route::put('/games/{game}/changelog/{changelog}', [AdminChangelogController::class, 'update']);
        Route::delete('/games/{game}/changelog/{changelog}', [AdminChangelogController::class, 'destroy']);

        // Ideas admin
        Route::get('/games/{game}/ideas', [AdminIdeaController::class, 'index']);
        Route::put('/ideas/{idea}/status', [AdminIdeaController::class, 'updateStatus']);
        Route::delete('/ideas/{idea}', [AdminIdeaController::class, 'destroy']);
        Route::delete('/ideas/comments/{comment}', [AdminIdeaController::class, 'destroyComment']);
    });
});
