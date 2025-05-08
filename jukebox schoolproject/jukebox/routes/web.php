<?php

use App\Http\Controllers\PlayController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Hier worden de web routes gedefinieerd voor onze applicatie.
| Deze routes worden geladen door de RouteServiceProvider.
|
*/

// Homepage redirect naar songs index
Route::get('/', function () {
    return redirect()->route('songs.index');
});

// Songs routes
Route::resource('songs', SongController::class);
Route::get('/statistics', [SongController::class, 'statistics'])->name('songs.statistics');

// Reviews routes (alleen store en destroy)
Route::post('/songs/{song}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

// Plays routes (alleen index)
Route::get('/plays', [PlayController::class, 'index'])->name('plays.index');
