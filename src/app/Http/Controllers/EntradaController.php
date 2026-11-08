<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Funcion;
use App\Models\Asiento;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EntradaController extends Controller
{
    // Listar entradas
    public function index()
    {
        $entradas = Entrada::with([
            'funcion.pelicula',
            'funcion.sala',
            'asiento'
        ])->orderBy('created_at', 'desc')->get();

        return view('entradas.index', compact('entradas'));
    }

    // Mostrar formulario de registro
    public function create()
    {
        $funciones = Funcion::with(['pelicula', 'sala'])
            ->where('fecha', '>=', today())
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return view('entradas.create', compact('funciones'));
    }
    
    // Obtener los asientos de una función y su disponibilidad
    public function obtenerAsientos(Funcion $funcion)
    {
        $asientos = Asiento::where('sala_id', $funcion->sala_id)
            ->orderBy('fila')
            ->orderBy('numero')
            ->get();

        $ocupados = Entrada::where('funcion_id', $funcion->id)
            ->whereIn('estado', ['activa', 'utilizada'])
            ->pluck('asiento_id');

        return response()->json([
            'asientos' => $asientos,
            'ocupados' => $ocupados
        ]);
    }
    
    // Consultar entradas por código o nombre del cliente
    // Consultar entradas por código o nombre del cliente
    public function buscar(Request $request)
    {
        $busqueda = $request->input('busqueda');

        // Si todavía no se ha realizado una búsqueda,
        // mostrar la vista vacía.
        if (!$busqueda) {
            $entradas = collect();

            return view('entradas.buscar', compact('entradas', 'busqueda'));
        }

        $request->validate([
            'busqueda' => 'required|string|max:70'
        ]);

        $entradas = Entrada::with([
            'funcion.pelicula',
            'funcion.sala',
            'asiento'
        ])
        ->where(function ($query) use ($busqueda) {
            $query->where('codigo', 'LIKE', "%{$busqueda}%")
                ->orWhere('nombre_cliente', 'LIKE', "%{$busqueda}%");
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('entradas.buscar', compact('entradas', 'busqueda'));
    }

    // Verificar el ingreso de una entrada
    public function verificar(Entrada $entrada)
    {
        if ($entrada->estado !== 'activa') {
            return back()->with(
                'error',
                'Esta entrada no se puede verificar porque ya fue utilizada o está cancelada.'
            );
        }

        $entrada->update([
            'estado' => 'utilizada'
        ]);

        return back()->with(
            'success',
            'Ingreso verificado correctamente. La entrada ahora está marcada como utilizada.'
        );
    }
    // Registrar una entrada
    public function store(Request $request)
    {
        $request->validate([
            'funcion_id' => 'required|exists:funcions,id',
            'asiento_id' => 'required|exists:asientos,id',
            'nombre_cliente' => 'required|string|max:70'
        ]);

        $funcion = Funcion::findOrFail($request->funcion_id);

        // Verificar que el asiento pertenezca a la sala de la función
        $asiento = Asiento::where('id', $request->asiento_id)
            ->where('sala_id', $funcion->sala_id)
            ->first();

        if (!$asiento) {
            return back()->withInput()->with(
                'error',
                'El asiento seleccionado no pertenece a la sala de esta función.'
            );
        }

        // Verificar que el asiento esté disponible
        $ocupado = Entrada::where('funcion_id', $funcion->id)
            ->where('asiento_id', $asiento->id)
            ->whereIn('estado', ['activa', 'utilizada'])
            ->exists();

        if ($ocupado) {
            return back()->withInput()->with(
                'error',
                'Este asiento ya está ocupado para la función seleccionada.'
            );
        }

        // Generar un código único
        do {
            $codigo = strtoupper(Str::random(10));
        } while (Entrada::where('codigo', $codigo)->exists());

        Entrada::create([
            'funcion_id' => $funcion->id,
            'asiento_id' => $asiento->id,
            'codigo' => $codigo,
            'nombre_cliente' => $request->nombre_cliente,
            'estado' => 'activa'
        ]);

        return redirect()->route('entradas.index')
            ->with('success', 'Entrada registrada correctamente. Código: ' . $codigo);
    }

    // Mostrar formulario de edición (no utilizado por ahora)
    public function edit(Entrada $entrada)
    {
        return redirect()->route('entradas.index');
    }

    // Actualizar entrada (no utilizado por ahora)
    public function update(Request $request, Entrada $entrada)
    {
        return redirect()->route('entradas.index');
    }

    // Cancelar una entrada
    public function destroy(Entrada $entrada)
    {
        if ($entrada->estado === 'cancelada') {
            return redirect()->route('entradas.index')
                ->with('error', 'Esta entrada ya se encuentra cancelada.');
        }

        $entrada->update([
            'estado' => 'cancelada'
        ]);

        return redirect()->route('entradas.index')
            ->with('success', 'Entrada cancelada correctamente.');
    }
}
