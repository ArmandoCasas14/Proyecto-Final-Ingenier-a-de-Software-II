
@extends('peliculas.layout')

@section('titulo', 'Editar función')
@section('seccion', 'Editar función')

@section('contenido')

<div class="panel">

    <h2>Actualizar función</h2>

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

    <form action="{{ route('funciones.update', $funcione) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="pelicula_id">Película:</label>
        <select name="pelicula_id" id="pelicula_id" required>
            @foreach($peliculas as $pelicula)
                <option value="{{ $pelicula->id }}"
                    {{ old('pelicula_id', $funcione->pelicula_id) == $pelicula->id ? 'selected' : '' }}>
                    {{ $pelicula->nombre }}
                </option>
            @endforeach
        </select>

        <label for="sala_id">Sala:</label>
        <select name="sala_id" id="sala_id" required>
            @foreach($salas as $sala)
                <option value="{{ $sala->id }}"
                    {{ old('sala_id', $funcione->sala_id) == $sala->id ? 'selected' : '' }}>
                    {{ $sala->nombre }} - Capacidad: {{ $sala->capacidad }}
                </option>
            @endforeach
        </select>

        <label for="fecha">Fecha:</label>
        <input
            type="date"
            name="fecha"
            id="fecha"
            value="{{ old('fecha', $funcione->fecha) }}"
            min="{{ date('Y-m-d') }}"
            required
        >

        <label for="hora">Hora:</label>
        <input
            type="time"
            name="hora"
            id="hora"
            value="{{ old('hora', substr($funcione->hora, 0, 5)) }}"
            required
        >

        <label for="precio">Precio de la entrada:</label>
        <input
            type="number"
            name="precio"
            id="precio"
            value="{{ old('precio', $funcione->precio) }}"
            min="0.01"
            step="0.01"
            required
        >

        <br><br>

        <button type="submit" class="btn">
            Guardar cambios
        </button>

        <a href="{{ route('funciones.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>

</div>

@endsection
