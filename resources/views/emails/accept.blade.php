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
        <h1>Oferta aceptada</h1>
        <h2>¡Tu oferta ha sido aceptada por el propietario!</h2>
        <p>La oferta que habías hecho al anuncio  {{ $ad->titulo }} ha sido aceptada.</p>
        <p>!Feliciades¡</p>
    </main>
    <footer class="page-footer font-small p-4 bg-light">
        <p>Aplicación crada por Carla Velasco como trabajo final de clase.</p>
        <p>Desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
    </footer>
</body>
</html>
