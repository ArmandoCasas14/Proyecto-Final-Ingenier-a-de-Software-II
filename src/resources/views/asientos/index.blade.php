@extends('peliculas.layout')

@section('titulo', 'Asientos')
@section('seccion', 'Distribución de asientos')

@section('contenido')

<div class="panel">

    <h2>Asientos de {{ $sala->nombre }}</h2>

    <p>
        <strong>Capacidad:</strong> {{ $sala->capacidad }} personas
    </p>

    <div style="margin: 30px auto; padding: 15px; max-width: 500px;
                background: #e5e7eb; border-radius: 8px;
                text-align: center; font-weight: bold;">
        PANTALLA
    </div>

    @foreach($asientos->groupBy('fila') as $fila => $grupo)

        <div style="display: flex; justify-content: center;
                    align-items: center; gap: 10px; margin-bottom: 15px;">

            <strong style="width: 25px;">{{ $fila }}</strong>

            @foreach($grupo as $asiento)

                <div style="width: 45px; height: 40px;
                            background: #d1fae5; border: 1px solid #059669;
                            border-radius: 6px; display: flex;
                            justify-content: center; align-items: center;
                            font-weight: bold;">

                    {{ $asiento->fila }}{{ $asiento->numero }}

                </div>

            @endforeach

        </div>

    @endforeach

    <br>

    <a href="{{ route('salas.index') }}" class="btn btn-secondary">
        Volver a salas
    </a>

</div>

@endsection
