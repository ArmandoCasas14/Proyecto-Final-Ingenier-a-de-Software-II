
@extends('peliculas.layout')

@section('titulo', 'Editar sala')
@section('seccion', 'Gestión de salas')

@section('contenido')

<div class="panel">

    <h2>Editar sala</h2>

    <form action="{{ route('salas.update', $sala) }}" method="POST">

        @csrf
        @method('PUT')

        <label for="nombre">Nombre de la sala</label>

        <input
            type="text"
            id="nombre"
            name="nombre"
            value="{{ old('nombre', $sala->nombre) }}">

        @error('nombre')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="filas">Cantidad de filas</label>

        <input
            type="number"
            id="filas"
            name="filas"
            min="1"
            value="{{ old('filas', $sala->filas) }}">

        @error('filas')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="asientos_for_fila">Asientos por fila</label>

        <input
            type="number"
            id="asientos_for_fila"
            name="asientos_for_fila"
            min="1"
            value="{{ old('asientos_for_fila', $sala->asientos_for_fila) }}">

        @error('asientos_for_fila')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn">
            Actualizar sala
        </button>

        <a href="{{ route('salas.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

@endsection
