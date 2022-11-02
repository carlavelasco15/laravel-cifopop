<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        {{ include 'css/bootstrap.min.css'; }}
    </style>
</head>
<body class="container p-3">
    <header class="container row bt-light p-4 my-4">
        <figure class="img-fluid col-2">
            <img src="{{ asset('images/Logos/Logo.png') }}" alt="Logo">
        </figure>
    </header>
    <main>
        <h1>Oferta rechazada</h1>
        <h2>¡Tu oferta ha sido rechazada por el propietario!</h2>
        <p>La oferta que habías hecho al anuncio  {{ $ad->titulo }} ha sido rechazada.</p>
        <p>Esto puede haber sido por varios hechos: el usuario ha rechazado tu oferta, el usuario ya ha vendido el producto o el usuario ha eliminado el anuncio.</p>
    </main>
    <footer class="page-footer font-small p-4 bg-light">
        <p>Aplicación crada por Carla Velasco como trabajo final de clase.</p>
        <p>Desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
    </footer>
</body>
</html>
