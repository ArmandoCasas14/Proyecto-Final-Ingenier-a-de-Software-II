<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaController extends Controller
{
    // Listar salas
    public function index()
    {
        $salas = Sala::all();

        return view('salas.index', compact('salas'));
    }

    // Mostrar formulario de registro
    public function create()
    {
        return view('salas.create');
    }

    // Registrar sala
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'filas' => 'required|integer|min:1',
            'asientos_for_fila' => 'required|integer|min:1'
        ]);

        $capacidad = $request->filas * $request->asientos_for_fila;

        Sala::create([
            'nombre' => $request->nombre,
            'filas' => $request->filas,
            'asientos_for_fila' => $request->asientos_for_fila,
            'capacidad' => $capacidad
        ]);

        return redirect()->route('salas.index')
            ->with('success', 'Sala registrada correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Sala $sala)
    {
        return view('salas.edit', compact('sala'));
    }

    // Actualizar sala
    public function update(Request $request, Sala $sala)
    {
        $request->validate([
        'nombre' => 'required|string|max:50',
        'filas' => 'required|integer|min:1',
        'asientos_for_fila' => 'required|integer|min:1'
    ]);

    // Verificar si la sala tiene funciones o asientos asociados
    $tieneFunciones = DB::table('funcions')
        ->where('sala_id', $sala->id)
        ->exists();

    $tieneAsientos = DB::table('asientos')
        ->where('sala_id', $sala->id)
        ->exists();

    // Verificar si se intenta modificar la distribución
    $configuracionCambio =
        $sala->filas != $request->filas ||
        $sala->asientos_for_fila != $request->asientos_for_fila;

    // Impedir cambios en la distribución si existen relaciones
    if (($tieneFunciones || $tieneAsientos) && $configuracionCambio) {
        return back()->withInput()->with(
            'error',
            'No puedes modificar la distribución de una sala que ya tiene asientos o funciones asociados.'
        );
    }

    // Calcular capacidad automáticamente
    $capacidad = $request->filas * $request->asientos_for_fila;

    // Actualizar información de la sala
    $sala->update([
        'nombre' => $request->nombre,
        'filas' => $request->filas,
        'asientos_for_fila' => $request->asientos_for_fila,
        'capacidad' => $capacidad
    ]);

    return redirect()->route('salas.index')
        ->with('success', 'Sala actualizada correctamente.');
    }

    // Eliminar sala
    public function destroy(Sala $sala)
    {
        $tieneFunciones = DB::table('funcions')
            ->where('sala_id', $sala->id)
            ->exists();

        $tieneAsientos = DB::table('asientos')
            ->where('sala_id', $sala->id)
            ->exists();

        if ($tieneFunciones || $tieneAsientos) {
            return redirect()->route('salas.index')
                ->with('error', 'No puedes eliminar una sala que tiene asientos o funciones asociados.');
        }

        $sala->delete();

        return redirect()->route('salas.index')
            ->with('success', 'Sala eliminada correctamente.');
    }
}
