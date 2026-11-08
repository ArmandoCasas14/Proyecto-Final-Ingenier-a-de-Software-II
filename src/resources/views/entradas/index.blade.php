
@extends('peliculas.layout')

@section('titulo', 'Entradas')
@section('seccion', 'Gestión de entradas')

@section('contenido')

<div class="panel">

    <h2>Gestión de entradas</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <a href="{{ route('entradas.create') }}" class="btn">
        + Registrar entrada
    </a>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Cliente</th>
                <th>Película</th>
                <th>Sala</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Asiento</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse($entradas as $entrada)
                <tr>
                    <td>{{ $entrada->codigo }}</td>

                    <td>{{ $entrada->nombre_cliente }}</td>

                    <td>{{ $entrada->funcion->pelicula->nombre }}</td>

                    <td>{{ $entrada->funcion->sala->nombre }}</td>

                    <td>{{ $entrada->funcion->fecha }}</td>

                    <td>{{ substr($entrada->funcion->hora, 0, 5) }}</td>

                    <td>
                        {{ $entrada->asiento->fila }}{{ $entrada->asiento->numero }}
                    </td>

                    <td>
                        {{ ucfirst($entrada->estado) }}
                    </td>

                    <td>
                        @if($entrada->estado === 'activa')
                            <form
                                action="{{ route('entradas.destroy', $entrada) }}"
                                method="POST"
                                onsubmit="return confirm('¿Deseas cancelar esta entrada?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">
                                    Cancelar
                                </button>
                            </form>
                        @else
                            <span>Sin acciones</span>
                        @endif
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="9">
                        No hay entradas registradas.
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
