<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SongController;
use App\Http\Middleware\AdminMiddleware;
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

// Authenticatie routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Admin-only routes
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // Admin song management
    Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
    Route::post('/songs', [SongController::class, 'store'])->name('songs.store');
    Route::get('/songs/{song}/edit', [SongController::class, 'edit'])->name('songs.edit');
    Route::put('/songs/{song}', [SongController::class, 'update'])->name('songs.update');
    Route::delete('/songs/{song}', [SongController::class, 'destroy'])->name('songs.destroy');

    // Admin review deletion
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Publieke routes - belangrijk: deze moeten NA de /songs/create route komen
Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
Route::get('/statistics', [SongController::class, 'statistics'])->name('songs.statistics');
Route::get('/songs/{song}', [SongController::class, 'show'])->name('songs.show');

// Reviews routes (alleen store)
Route::post('/songs/{song}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Plays routes (alleen index)
Route::get('/plays', [PlayController::class, 'index'])->name('plays.index');
