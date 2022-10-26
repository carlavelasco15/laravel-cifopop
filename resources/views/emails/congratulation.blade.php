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
        <h1>Felicidades</h1>
        <h2>¡Has publicado tu primer moto en Laraads!</h2>
        <p>Tu nueva moto {{ $ad->marca. ' ' . $ad->modelo }} ya aparece en los resultados.</p>
        <p>Sigue así, estás colaborando para que LaraAds se convierta en la primera red de usuarios de motocicletas de los CIFO.</p>
    </main>
    <footer class="page-footer font-small p-4 bg-light">
        <p>Aplicación crada por Rober Sallent como ejemplo de clase.</p>
        <p>Desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
    </footer>
</body>
</html>
