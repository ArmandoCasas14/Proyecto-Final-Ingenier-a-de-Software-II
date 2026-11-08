
@extends('peliculas.layout')

@section('titulo', 'Películas')

@section('contenido')

<div class="panel">

    <h2>Gestión de películas</h2>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('peliculas.create') }}" class="btn">
        + Registrar película
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de la película</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse($peliculas as $pelicula)
                <tr>
                    <td>{{ $pelicula->id }}</td>

                    <td>{{ $pelicula->nombre }}</td>

                    <td>
                        <div class="actions">

                            <a href="{{ route('peliculas.edit', $pelicula) }}"
                               class="btn">
                                Editar
                            </a>

                            <form
                                action="{{ route('peliculas.destroy', $pelicula) }}"
                                method="POST"
                                class="inline"
                                onsubmit="return confirm('¿Deseas eliminar esta película?')">

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
                    <td colspan="3">
                        No hay películas registradas.
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
