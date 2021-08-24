<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Screencast\PlaylistController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('playlists')->name('playlists.')->middleware('permission:create playlist')->group(function () {
        Route::get('create', [PlaylistController::class, 'create'])->name('create');
        Route::get('table', [PlaylistController::class, 'table'])->name('table');
    });
});

require __DIR__ . '/auth.php';
