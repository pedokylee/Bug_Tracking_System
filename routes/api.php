<?php

use App\Http\Controllers\Api\BugApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API — consumed by frontend via Axios (api.js service)
Route::prefix('v1')->group(function () {
    // Public bug stats endpoint
    Route::get('/stats', [BugApiController::class, 'stats'])->name('api.stats');

    // Public project listing
    Route::get('/projects', [BugApiController::class, 'projects'])->name('api.projects');

    // Authenticated API routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('bugs', BugApiController::class);
        Route::patch('/bugs/{bug}/status', [BugApiController::class, 'updateStatus'])->name('api.bugs.status');
        Route::patch('/bugs/{bug}/assign', [BugApiController::class, 'assign'])->name('api.bugs.assign');
        Route::get('/bugs/by-priority', [BugApiController::class, 'byPriority'])->name('api.bugs.priority');
        Route::get('/bugs/by-status', [BugApiController::class, 'byStatus'])->name('api.bugs.status-group');
    });
});