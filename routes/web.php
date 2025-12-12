<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PokemonController;

Route::get('/inicio', [PokemonController::class, 'index'])
    ->name('pokemon.index');

Route::get('/pokemon/{name}', [PokemonController::class, 'show'])
    ->name('pokemon.show');

// PDF lista completa
Route::get('/pdf/lista', [PokemonController::class, 'pdfList'])->name('pokemon.pdf');

// PDF individual
Route::get('/pdf/pokemon/{name}', [PokemonController::class, 'pdfSingle'])->name('pokemon.pdf.single');

