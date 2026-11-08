
@extends('peliculas.layout')

@section('titulo', 'Salas')
@section('seccion', 'Gestión de salas')

@section('contenido')

<div class="panel">

    <h2>Gestión de salas</h2>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <a href="{{ route('salas.create') }}" class="btn">
        + Registrar sala
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Filas</th>
                <th>Asientos por fila</th>
                <th>Capacidad</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse($salas as $sala)
                <tr>
                    <td>{{ $sala->id }}</td>
                    <td>{{ $sala->nombre }}</td>
                    <td>{{ $sala->filas }}</td>
                    <td>{{ $sala->asientos_for_fila }}</td>
                    <td>{{ $sala->capacidad }}</td>

                    <td>
                        <div class="actions">
                            <a href="{{ route('salas.asientos', $sala) }}"
                                class="btn">
                                Ver asientos
                            </a>
                            <a href="{{ route('salas.edit', $sala) }}"
                               class="btn">
                                Editar
                            </a>

                            <form
                                action="{{ route('salas.destroy', $sala) }}"
                                method="POST"
                                class="inline"
                                onsubmit="return confirm('¿Deseas eliminar esta sala?')">

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
                    <td colspan="6">
                        No hay salas registradas.
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
