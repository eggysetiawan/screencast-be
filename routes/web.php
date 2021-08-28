<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Screencast\{PlaylistController, TagController, VideoController};


Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    // playlists
    Route::prefix('playlists')->name('playlists.')->middleware('permission:create playlists')->group(function () {
        Route::get('create', [PlaylistController::class, 'create'])->name('create');
        Route::post('create', [PlaylistController::class, 'store'])->name('store');
        Route::get('table', [PlaylistController::class, 'table'])->name('table');
        Route::get('{playlist:slug}/edit', [PlaylistController::class, 'edit'])->name('edit');
        Route::put('{playlist:slug}/update', [PlaylistController::class, 'update'])->name('update');
        Route::delete('{playlist:slug}/delete', [PlaylistController::class, 'destroy'])->name('destroy');
    });

    // tags
    Route::prefix('tags')->name('tags.')->group(function () {
        Route::middleware('permission:create tags')->group(function () {
            Route::get('create', [TagController::class, 'create'])->name('create');
            Route::post('store', [TagController::class, 'store'])->name('store');
            Route::get('table', [TagController::class, 'table'])->name('table');
        });


        Route::middleware('permission:modify tags')->group(function () {
            Route::get('{tag:slug}/edit', [TagController::class, 'edit'])->name('edit');
            Route::put('{tag:slug}/update', [TagController::class, 'update'])->name('update');
            Route::delete('{tag:slug}/delete', [TagController::class, 'destroy'])->name('destroy');
        });
    });

    // videos
    Route::prefix('videos')->name('videos.')->middleware('permission:create playlists')->group(function () {
        Route::get('{playlist:slug}', [VideoController::class, 'table'])->name('table');
        Route::get('{playlist:slug}/create', [VideoController::class, 'create'])->name('create');
        Route::post('{playlist:slug}/store', [VideoController::class, 'store'])->name('store');
        Route::get('{video:unique_video_id}/edit', [VideoController::class, 'edit'])->name('edit');
        Route::put('{video:unique_video_id}/update', [VideoController::class, 'update'])->name('update');
        Route::delete('{video:unique_video_id}/delete', [VideoController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__ . '/auth.php';
