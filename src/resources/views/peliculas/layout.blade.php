
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo') | CineManager</title>

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

        header {
            background: #202337;
            color: white;
            padding: 20px 35px;
        }

        header a {
            color: white;
            text-decoration: none;
        }

        main {
            max-width: 1000px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .panel {
            background: white;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #e8e9ef;
        }

        h2 {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            background: #353b59;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-danger {
            background: #c0392b;
        }

        .btn-secondary {
            background: #777b8c;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0 18px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        label {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f4f5f9;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .error {
            color: #c0392b;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        form.inline {
            display: inline;
        }
    </style>
</head>

<body>

<header>
    <a href="{{ route('inicio') }}">🎬 CineManager</a>
    <span> / @yield('seccion', 'Gestión de películas')</span>
</header>

<main>
    @yield('contenido')
</main>

</body>
</html>
