<?php

namespace App\Http\Controllers;

use App\Models\Funcion;
use App\Models\Pelicula;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuncionController extends Controller
{
    // Listar funciones
    public function index()
    {
        $funciones = Funcion::with(['pelicula', 'sala'])
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return view('funciones.index', compact('funciones'));
    }

    // Mostrar formulario de registro
    public function create()
    {
        $peliculas = Pelicula::all();
        $salas = Sala::all();

        return view('funciones.create', compact('peliculas', 'salas'));
    }

    // Registrar función
    public function store(Request $request)
    {
        $request->validate([
            'pelicula_id' => 'required|exists:peliculas,id',
            'sala_id' => 'required|exists:salas,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'precio' => 'required|numeric|min:0.01'
        ]);

        // Verificar que la sala no tenga otra función en el mismo horario
        $existeFuncion = Funcion::where('sala_id', $request->sala_id)
            ->where('fecha', $request->fecha)
            ->where('hora', $request->hora)
            ->exists();

        if ($existeFuncion) {
            return back()->withInput()->with(
                'error',
                'La sala ya tiene una función programada en esa fecha y hora.'
            );
        }

        Funcion::create([
            'pelicula_id' => $request->pelicula_id,
            'sala_id' => $request->sala_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'precio' => $request->precio
        ]);

        return redirect()->route('funciones.index')
            ->with('success', 'Función registrada correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Funcion $funcione)
    {
        $peliculas = Pelicula::all();
        $salas = Sala::all();

        return view('funciones.edit', compact(
            'funcione',
            'peliculas',
            'salas'
        ));
    }

    // Actualizar función
    public function update(Request $request, Funcion $funcione)
    {
        $request->validate([
            'pelicula_id' => 'required|exists:peliculas,id',
            'sala_id' => 'required|exists:salas,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'precio' => 'required|numeric|min:0.01'
        ]);

        // Verificar si existe otra función en el mismo horario
        $existeFuncion = Funcion::where('sala_id', $request->sala_id)
            ->where('fecha', $request->fecha)
            ->where('hora', $request->hora)
            ->where('id', '!=', $funcione->id)
            ->exists();

        if ($existeFuncion) {
            return back()->withInput()->with(
                'error',
                'La sala ya tiene otra función programada en esa fecha y hora.'
            );
        }

        $funcione->update([
            'pelicula_id' => $request->pelicula_id,
            'sala_id' => $request->sala_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'precio' => $request->precio
        ]);

        return redirect()->route('funciones.index')
            ->with('success', 'Función actualizada correctamente.');
    }

    // Eliminar función
    public function destroy(Funcion $funcione)
    {
        $tieneEntradas = DB::table('entradas')
            ->where('funcion_id', $funcione->id)
            ->exists();

        if ($tieneEntradas) {
            return redirect()->route('funciones.index')
                ->with('error', 'No puedes eliminar una función que tiene entradas asociadas.');
        }

        $funcione->delete();

        return redirect()->route('funciones.index')
            ->with('success', 'Función eliminada correctamente.');
    }
}
