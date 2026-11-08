<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peliculas = Pelicula::all();

        return view('peliculas.index', compact('peliculas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('peliculas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50'
        ]);

        Pelicula::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('peliculas.index')
            ->with('success', 'Película registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelicula $pelicula)
    {
        return view('peliculas.show', compact('pelicula'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelicula $pelicula)
    {
        return view('peliculas.edit', compact('pelicula'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelicula $pelicula)
    {
        $request->validate([
            'nombre' => 'required|string|max:50'
        ]);

        $pelicula->update([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('peliculas.index')
            ->with('success', 'Película actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelicula $pelicula)
    {
        $pelicula->delete();

        return redirect()->route('peliculas.index')
            ->with('success', 'Película eliminada correctamente.');
    }
}
