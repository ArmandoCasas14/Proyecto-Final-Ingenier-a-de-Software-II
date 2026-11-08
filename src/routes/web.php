<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\AsientoController;
use App\Http\Controllers\FuncionController;
use App\Http\Controllers\EntradaController;


Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::resource('peliculas', PeliculaController::class)
->except(['show']);
Route::resource('salas', SalaController::class)
    ->except(['show']);
Route::get('/salas/{sala}/asientos', [AsientoController::class, 'index'])
    ->name('salas.asientos');  
Route::resource('funciones', FuncionController::class)->except(['show']);
Route::get('/funciones/{funcion}/asientos', [EntradaController::class, 'obtenerAsientos'])
    ->name('funciones.asientos');
Route::resource('entradas', EntradaController::class)
    ->except(['show', 'edit', 'update']);
Route::get('/entradas/buscar', [EntradaController::class, 'buscar'])
    ->name('entradas.buscar');
Route::post('/entradas/{entrada}/verificar', [EntradaController::class, 'verificar'])
    ->name('entradas.verificar');