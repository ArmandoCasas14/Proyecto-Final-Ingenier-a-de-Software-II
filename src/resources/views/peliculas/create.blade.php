
@extends('peliculas.layout')

@section('titulo', 'Registrar película')

@section('contenido')

<div class="panel">

    <h2>Registrar película</h2>

    <form action="{{ route('peliculas.store') }}" method="POST">

        @csrf

        <label for="nombre">Nombre de la película</label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            value="{{ old('nombre') }}"
            placeholder="Ingrese el nombre de la película">

        @error('nombre')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn">
            Guardar película
        </button>

        <a href="{{ route('peliculas.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

@endsection
