
@extends('peliculas.layout')

@section('titulo', 'Registrar sala')
@section('seccion', 'Gestión de salas')

@section('contenido')

<div class="panel">

    <h2>Registrar sala</h2>

    <form action="{{ route('salas.store') }}" method="POST">

        @csrf

        <label for="nombre">Nombre de la sala</label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            value="{{ old('nombre') }}"
            placeholder="Ejemplo: Sala 1">

        @error('nombre')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="filas">Cantidad de filas</label>

        <input
            type="number"
            id="filas"
            name="filas"
            min="1"
            value="{{ old('filas') }}"
            placeholder="Ejemplo: 5">

        @error('filas')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="asientos_for_fila">Asientos por fila</label>

        <input
            type="number"
            id="asientos_for_fila"
            name="asientos_for_fila"
            min="1"
            value="{{ old('asientos_for_fila') }}"
            placeholder="Ejemplo: 8">

        @error('asientos_for_fila')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn">
            Guardar sala
        </button>

        <a href="{{ route('salas.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

@endsection
