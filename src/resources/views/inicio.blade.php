
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CineManager | Inicio</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f5f9;
            color: #25283b;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* Barra lateral */
        .sidebar {
            width: 250px;
            background: #202337;
            color: white;
            padding: 28px 18px;
        }

        .logo {
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 45px;
            padding-left: 10px;
        }

        .sidebar p {
            color: #9296aa;
            font-size: 12px;
            margin: 25px 10px 12px;
            text-transform: uppercase;
        }

        .sidebar a {
            display: block;
            padding: 13px 12px;
            margin-bottom: 7px;
            color: #c9cada;
            text-decoration: none;
            border-radius: 7px;
            transition: .2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #393e5a;
            color: white;
        }

        /* Contenido */
        .main {
            flex: 1;
            padding: 35px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .header h1 {
            font-size: 26px;
        }

        .header span {
            color: #777b8c;
            font-size: 14px;
        }

        .welcome {
            background: #353b59;
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .welcome h2 {
            margin-bottom: 12px;
        }

        .welcome p {
            color: #d5d7e3;
        }

        .section-title {
            margin-bottom: 20px;
            font-size: 19px;
        }

        .modules {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .module {
            background: white;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #e8e9ef;
            text-decoration: none;
            color: inherit;
            transition: .2s;
        }

        .module:hover {
            transform: translateY(-3px);
            border-color: #777da5;
        }

        .module .icon {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .module h3 {
            margin-bottom: 9px;
        }

        .module p {
            color: #777b8c;
            font-size: 14px;
            line-height: 1.5;
        }

        @media (max-width: 700px) {
            .sidebar {
                width: 175px;
            }

            .main {
                padding: 20px;
            }

            .modules {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <aside class="sidebar">

        <div class="logo">🎬 CineManager</div>

        <p>Principal</p>

        <a href="{{ route('inicio') }}" class="active">
            🏠 Inicio
        </a>

        <p>Gestión del cine</p>

        <a href="{{ url('/peliculas') }}">🎞️ Películas</a>
        <a href="{{ url('/salas') }}">🏢 Salas</a>
        <a href="{{ url('/funciones') }}">📅 Funciones</a>

        <p>Entradas</p>

        <a href="{{ url('/entradas') }}">🎟️ Registrar entradas</a>
        <a href="{{ route('entradas.buscar') }}">🔎 Consultar entradas</a>

    </aside>

    <main class="main">

        <header class="header">
            <h1>Panel principal</h1>
            <span>Sistema de gestión de cine</span>
        </header>

        <section class="welcome">
            <h2>¡Bienvenido a CineManager!</h2>
            <p>
                Administra las películas, salas, funciones y entradas
                de tu cine desde un solo lugar.
            </p>
        </section>

        <h2 class="section-title">Módulos del sistema</h2>

        <section class="modules">

            <a href="{{ url('/peliculas') }}" class="module">
                <div class="icon">🎞️</div>
                <h3>Películas</h3>
                <p>Consulta y administra las películas disponibles.</p>
            </a>

            <a href="{{ url('/salas') }}" class="module">
                <div class="icon">🏢</div>
                <h3>Salas</h3>
                <p>Gestiona las salas y su capacidad de asientos.</p>
            </a>

            <a href="{{ url('/funciones') }}" class="module">
                <div class="icon">📅</div>
                <h3>Funciones</h3>
                <p>Registra, consulta, modifica y elimina funciones.</p>
            </a>

            <a href="{{ url('/entradas') }}" class="module">
                <div class="icon">🎟️</div>
                <h3>Entradas</h3>
                <p>Registra entradas y administra la venta de asientos.</p>
            </a>

            <a href="{{ url('/consultar-entradas') }}" class="module">
                <div class="icon">🔎</div>
                <h3>Verificar entradas</h3>
                <p>Busca entradas por código o nombre del cliente.</p>
            </a>

        </section>

    </main>

</div>

</body>
</html>
