<?php

namespace App\Http\Controllers;

use App\Models\Sala;

class AsientoController extends Controller
{
    // Mostrar los asientos de una sala
    public function index(Sala $sala)
    {
        $asientos = $sala->asientos()
            ->orderBy('fila')
            ->orderBy('numero')
            ->get();

        return view('asientos.index', compact('sala', 'asientos'));
    }
}