<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BugController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Landing');
})->name('landing');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Projects Routes
    Route::resource('projects', ProjectController::class)->only([
        'index', 'show', 'create', 'store', 'destroy'
    ]);

    // Bugs Routes (nested under projects)
    Route::middleware(['project.access'])->group(function () {
        Route::resource('projects.bugs', BugController::class)->only([
            'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
        ]);
    });

    // Comments
    Route::post('/bugs/{bug}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__ . '/auth.php';