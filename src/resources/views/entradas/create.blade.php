
@extends('peliculas.layout')

@section('titulo', 'Registrar entrada')
@section('seccion', 'Registrar entrada')

@section('contenido')

<div class="panel">

    <h2>Registrar nueva entrada</h2>

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

    <form action="{{ route('entradas.store') }}" method="POST">
        @csrf

        <label for="funcion_id">Función:</label>

        <select name="funcion_id" id="funcion_id" required>
            <option value="">Seleccione una función</option>

            @foreach($funciones as $funcion)
                <option
                    value="{{ $funcion->id }}"
                    {{ old('funcion_id') == $funcion->id ? 'selected' : '' }}>

                    {{ $funcion->pelicula->nombre }}
                    - {{ $funcion->sala->nombre }}
                    - {{ $funcion->fecha }}
                    - {{ substr($funcion->hora, 0, 5) }}

                </option>
            @endforeach
        </select>

        <label>Seleccione un asiento:</label>

        <input
            type="hidden"
            name="asiento_id"
            id="asiento_id"
            value="{{ old('asiento_id') }}"
            required
        >

        <div class="leyenda-asientos">
            <span><i class="asiento disponible"></i> Disponible</span>
            <span><i class="asiento ocupado"></i> Ocupado</span>
            <span><i class="asiento seleccionado"></i> Seleccionado</span>
        </div>

        <div id="contenedor-asientos">
            <p>Seleccione una función para visualizar sus asientos.</p>
        </div>

        <p id="asiento-seleccionado">
            Ningún asiento seleccionado.
        </p>

        <label for="nombre_cliente">Nombre del cliente:</label>

        <input
            type="text"
            name="nombre_cliente"
            id="nombre_cliente"
            value="{{ old('nombre_cliente') }}"
            maxlength="70"
            placeholder="Nombre completo del cliente"
            required
        >

        <br><br>

        <button type="submit" class="btn">
            Registrar entrada
        </button>

        <a href="{{ route('entradas.index') }}" class="btn btn-secondary">
            Cancelar
        </a>

    </form>

</div>

<style>
    .leyenda-asientos {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin: 15px 0;
    }

    .leyenda-asientos span {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .asiento {
        width: 25px;
        height: 25px;
        border-radius: 6px 6px 3px 3px;
        display: inline-block;
        border: none;
    }

    .disponible {
        background: #28a745;
    }

    .ocupado {
        background: #dc3545;
        cursor: not-allowed;
    }

    .seleccionado {
        background: #007bff;
    }

    #contenedor-asientos {
        margin-top: 20px;
        padding: 20px;
        overflow-x: auto;
        border: 1px solid #ddd;
        border-radius: 10px;
        text-align: center;
    }

    .pantalla {
        background: #555;
        color: white;
        padding: 10px;
        margin: 0 auto 30px;
        max-width: 450px;
        border-radius: 50% 50% 8px 8px;
        letter-spacing: 4px;
    }

    .fila-asientos {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        min-width: max-content;
    }

    .nombre-fila {
        width: 25px;
        font-weight: bold;
    }

    .boton-asiento {
        width: 35px;
        height: 35px;
        border-radius: 7px 7px 4px 4px;
        border: none;
        color: white;
        cursor: pointer;
    }

    .boton-asiento.disponible {
        background: #28a745;
    }

    .boton-asiento.ocupado {
        background: #dc3545;
        cursor: not-allowed;
        opacity: 0.7;
    }

    .boton-asiento.seleccionado {
        background: #007bff;
        outline: 3px solid #8bbcff;
    }

    .boton-asiento:disabled {
        cursor: not-allowed;
    }
</style>

<script>
    const selectorFuncion = document.getElementById('funcion_id');
    const contenedor = document.getElementById('contenedor-asientos');
    const campoAsiento = document.getElementById('asiento_id');
    const textoSeleccionado = document.getElementById('asiento-seleccionado');

    const urlBase = @json(route('funciones.asientos', ['funcion' => '__ID__']));

    const asientoAnterior = @json(old('asiento_id'));

    let asientoSeleccionado = null;

    selectorFuncion.addEventListener('change', cargarAsientos);

    async function cargarAsientos() {
        const funcionId = selectorFuncion.value;

        campoAsiento.value = '';
        asientoSeleccionado = null;
        textoSeleccionado.textContent = 'Ningún asiento seleccionado.';

        if (!funcionId) {
            contenedor.innerHTML = '<p>Seleccione una función para visualizar sus asientos.</p>';
            return;
        }

        contenedor.innerHTML = '<p>Cargando asientos...</p>';

        try {
            const url = urlBase.replace('__ID__', funcionId);

            const respuesta = await fetch(url);

            if (!respuesta.ok) {
                throw new Error('No se pudieron consultar los asientos.');
            }

            const datos = await respuesta.json();

            mostrarAsientos(datos.asientos, datos.ocupados);

        } catch (error) {
            contenedor.textContent = error.message;
        }
    }

    function mostrarAsientos(asientos, ocupados) {
        contenedor.innerHTML = '';

        if (asientos.length === 0) {
            contenedor.textContent = 'Esta sala todavía no tiene asientos registrados.';
            return;
        }

        const pantalla = document.createElement('div');
        pantalla.className = 'pantalla';
        pantalla.textContent = 'PANTALLA';
        contenedor.appendChild(pantalla);

        const filas = {};

        asientos.forEach(asiento => {
            if (!filas[asiento.fila]) {
                filas[asiento.fila] = [];
            }

            filas[asiento.fila].push(asiento);
        });

        Object.keys(filas).sort().forEach(fila => {
            const contenedorFila = document.createElement('div');
            contenedorFila.className = 'fila-asientos';

            const etiqueta = document.createElement('span');
            etiqueta.className = 'nombre-fila';
            etiqueta.textContent = fila;

            contenedorFila.appendChild(etiqueta);

            filas[fila].forEach(asiento => {
                const boton = document.createElement('button');

                boton.type = 'button';
                boton.className = 'boton-asiento';
                boton.textContent = asiento.numero;

                const estaOcupado = ocupados.includes(asiento.id);

                if (estaOcupado) {
                    boton.classList.add('ocupado');
                    boton.disabled = true;
                    boton.title = 'Asiento ocupado';
                } else {
                    boton.classList.add('disponible');
                    boton.title = 'Asiento disponible';

                    boton.addEventListener('click', function () {
                        seleccionarAsiento(asiento, boton);
                    });
                }

                contenedorFila.appendChild(boton);
            });

            contenedor.appendChild(contenedorFila);
        });

        // Recuperar el asiento anterior si sigue disponible
        if (asientoAnterior) {
            const botonAnterior = Array.from(
                contenedor.querySelectorAll('.boton-asiento')
            ).find(boton => {
                return asientos.some(asiento =>
                    asiento.id == asientoAnterior &&
                    asiento.numero == boton.textContent &&
                    !ocupados.includes(asiento.id)
                );
            });

            if (botonAnterior) {
                const asiento = asientos.find(
                    asiento => asiento.id == asientoAnterior
                );

                seleccionarAsiento(asiento, botonAnterior);
            }
        }
    }

    function seleccionarAsiento(asiento, boton) {
        document.querySelectorAll('.boton-asiento.seleccionado')
            .forEach(elemento => {
                elemento.classList.remove('seleccionado');
                elemento.classList.add('disponible');
            });

        boton.classList.remove('disponible');
        boton.classList.add('seleccionado');

        asientoSeleccionado = asiento.id;
        campoAsiento.value = asiento.id;

        textoSeleccionado.textContent =
            'Asiento seleccionado: ' + asiento.fila + asiento.numero;
    }

    // Cargar automáticamente la función anterior si existe
    if (selectorFuncion.value) {
        cargarAsientos();
    }
</script>

@endsection
