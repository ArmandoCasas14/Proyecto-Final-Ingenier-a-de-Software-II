<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\SalaController;


Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::resource('peliculas', PeliculaController::class)
->except(['show']);
Route::resource('salas', SalaController::class)
    ->except(['show']);