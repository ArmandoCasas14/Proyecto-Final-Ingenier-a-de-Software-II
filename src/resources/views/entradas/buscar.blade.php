
@extends('peliculas.layout')

@section('titulo', 'Buscar entradas')
@section('seccion', 'Consultar entradas')

@section('contenido')

<div class="panel">

    <h2>Consultar entradas</h2>

    <form action="{{ route('entradas.buscar') }}" method="GET">

        <label for="busqueda">Código o nombre del cliente:</label>

        <input
            type="text"
            name="busqueda"
            id="busqueda"
            value="{{ $busqueda }}"
            placeholder="Ingrese el código o nombre"
            maxlength="70"
            required
        >

        <br><br>

        <button type="submit" class="btn">
            Buscar
        </button>

        <a href="{{ route('entradas.index') }}" class="btn btn-secondary">
            Volver
        </a>

    </form>

    <br>

    <h3>Resultados de búsqueda</h3>

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
                    <td>{{ $entrada->asiento->fila }}{{ $entrada->asiento->numero }}</td>
                    <td>{{ ucfirst($entrada->estado) }}</td>
                </tr>

            @empty

                <tr>
                    <td colspan="8">
                        No se encontraron entradas con esos datos.
                    </td>
                </tr>

            @endforelse
        </tbody>
    </table>

</div>

@endsection
