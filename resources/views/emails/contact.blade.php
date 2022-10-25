<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        * {
            font-family: arial, verdana, helvetica;
        }

        header, main, footer {
            border: solid 1px #ddd;
            padding: 15px;
            margin: 10px;
        }

        header, footer {
            background-color: #eee;
        }
        header{display: flex;}
        header figure{flex: 1}
        header h1{flex: 4}
        .cursiva{font-style: italic}
    </style>
</head>
<body class="container p-3">
    <header class="container bg-light">
        <figure class="img-fluid m-2">
            <img src="{{ asset('images/logos/logo.png') }}" alt="logo">
        </figure>
        <h1>{{ config('app.name') }}</h1>
    </header>
    <main>
        <h2>Mensaje recibido: {{ $mensaje->asunto }}</h2>
        <p class="cursiva">De {{ $mensaje->nombre }}
            <a href="mailto: {{ $mensaje->email }}">&lt;{{ $mensaje->email }}&gt;</a>
        </p>
        <p>{{ $mensaje->mensaje }}</p>

        </form>
    </main>
    <footer class="page-footer font-small p-4 bg-light">
        <p>Aplicación crada por Robert Sallent para CIFO Sabadell como ejemplo de clase.
        Desarrollalda haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
    </footer>
</body>
</html>
