<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;


Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::resource('peliculas', PeliculaController::class)
->except(['show']);