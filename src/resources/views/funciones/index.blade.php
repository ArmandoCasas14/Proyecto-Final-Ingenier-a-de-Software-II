
@extends('peliculas.layout')

@section('titulo', 'Funciones')
@section('seccion', 'Gestión de funciones')

@section('contenido')

<div class="panel">

    <h2>Gestión de funciones</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <a href="{{ route('funciones.create') }}" class="btn">
        + Programar función
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Película</th>
                <th>Sala</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse($funciones as $funcion)
                <tr>
                    <td>{{ $funcion->id }}</td>
                    <td>{{ $funcion->pelicula->nombre }}</td>
                    <td>{{ $funcion->sala->nombre }}</td>
                    <td>{{ $funcion->fecha }}</td>
                    <td>{{ $funcion->hora }}</td>
                    <td>${{ number_format($funcion->precio, 2, ',', '.') }}</td>

                    <td>
                        <div class="actions">

                            <a href="{{ route('funciones.edit', $funcion) }}"
                               class="btn">
                                Editar
                            </a>

                            <form
                                action="{{ route('funciones.destroy', $funcion) }}"
                                method="POST"
                                class="inline"
                                onsubmit="return confirm('¿Deseas eliminar esta función?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">
                                    Eliminar
                                </button>

                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        No hay funciones programadas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <a href="{{ route('inicio') }}" class="btn btn-secondary">
        Volver al inicio
    </a>

</div>

@endsection
