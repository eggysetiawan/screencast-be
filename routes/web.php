<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Screencast\PlaylistController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('playlists')->name('playlists.')->middleware('permission:create playlists')->group(function () {
        Route::get('create', [PlaylistController::class, 'create'])->name('create');
        Route::post('create', [PlaylistController::class, 'store'])->name('store');
        Route::get('table', [PlaylistController::class, 'table'])->name('table');
        Route::get('{playlist:slug}/edit', [PlaylistController::class, 'edit'])->name('edit');
        Route::put('{playlist:slug}/update', [PlaylistController::class, 'update'])->name('update');
        Route::delete('{playlist:slug}/delete', [PlaylistController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__ . '/auth.php';
