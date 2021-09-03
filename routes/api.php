<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Screencast\Api\VideoController;
use App\Http\Controllers\Screencast\Api\PlaylistController;

Route::prefix('playlists')->group(function () {
    Route::get('', [PlaylistController::class, 'index']);
    Route::get('{playlist:slug}', [PlaylistController::class, 'show']);

    Route::get('{playlist:slug}/videos', [VideoController::class, 'index']);
    Route::get('{playlist:slug}/{video:episode}', [VideoController::class, 'show']);
});
