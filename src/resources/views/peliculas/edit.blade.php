
@extends('peliculas.layout')

@section('titulo', 'Editar película')

@section('contenido')

<div class="panel">

    <h2>Editar película</h2>

    <form action="{{ route('peliculas.update', $pelicula) }}" method="POST">

        @csrf
        @method('PUT')

        <label for="nombre">Nombre de la película</label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            value="{{ old('nombre', $pelicula->nombre) }}">

        @error('nombre')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn">
            Actualizar película
        </button>

        <a href="{{ route('peliculas.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

@endsection
