
@extends('peliculas.layout')

@section('titulo', 'Programar función')
@section('seccion', 'Programar función')

@section('contenido')

<div class="panel">

    <h2>Registrar nueva función</h2>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('funciones.store') }}" method="POST">
        @csrf

        <label for="pelicula_id">Película:</label>
        <select name="pelicula_id" id="pelicula_id" required>
            <option value="">Seleccione una película</option>

            @foreach($peliculas as $pelicula)
                <option value="{{ $pelicula->id }}"
                    {{ old('pelicula_id') == $pelicula->id ? 'selected' : '' }}>
                    {{ $pelicula->nombre }}
                </option>
            @endforeach
        </select>

        <label for="sala_id">Sala:</label>
        <select name="sala_id" id="sala_id" required>
            <option value="">Seleccione una sala</option>

            @foreach($salas as $sala)
                <option value="{{ $sala->id }}"
                    {{ old('sala_id') == $sala->id ? 'selected' : '' }}>
                    {{ $sala->nombre }} - Capacidad: {{ $sala->capacidad }}
                </option>
            @endforeach
        </select>

        <label for="fecha">Fecha:</label>
        <input
            type="date"
            name="fecha"
            id="fecha"
            value="{{ old('fecha') }}"
            min="{{ date('Y-m-d') }}"
            required
        >

        <label for="hora">Hora:</label>
        <input
            type="time"
            name="hora"
            id="hora"
            value="{{ old('hora') }}"
            required
        >

        <label for="precio">Precio de la entrada:</label>
        <input
            type="number"
            name="precio"
            id="precio"
            value="{{ old('precio') }}"
            min="0.01"
            step="0.01"
            placeholder="Ejemplo: 15000"
            required
        >

        <br><br>

        <button type="submit" class="btn">
            Programar función
        </button>

        <a href="{{ route('funciones.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>

</div>

@endsection
