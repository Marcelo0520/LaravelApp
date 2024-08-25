<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;

// Ruta para la página principal
Route::get('/', function () {
    return view('welcome');
});

// Ruta para la búsqueda de anime
Route::get('/search', [AnimeController::class, 'search']);

