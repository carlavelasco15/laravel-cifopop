@extends('layouts.app')
@php($pagina = Route::currentRouteName())
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Aplicación de gestión de anuncios Laraads">
    <title>{{config('app.name')}} - @yield('titulo')</title>

    <!-- CSS para Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">

</head>
@section('content')
    @section('navegacion')
    @php ($pagina = $pagina ?? '')
        <nav>
            <ul class="nav nav-pills my-2">
                <li class="nav-item ms-2">
                    <a class="nav-link {{ $pagina == 'portada' ? 'active': '' }}" href="{{url('/')}}">Inici</a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link {{ $pagina == 'ads.index' ||
                                        $pagina == 'ads.search' ? 'active': '' }}" href="{{route('ads.index')}}">Anuncios</a>

                </li>
                @auth
                    <li class="nav-item ms-2">
                        <a class="nav-link {{ $pagina == 'home' ? 'active': '' }}" href="{{route('home')}}">Mis anuncios</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link {{ $pagina == 'ads.create' ? 'active': '' }}" href="{{route('ads.create')}}">Nuevos anuncios</a>
                    </li>
                @endauth
                <li class="nav-item ms-2">
                    <a href="{{ route('contacto') }}" class="nav-link {{ $pagina == 'contacto' ? 'active' : '' }}">Contacto</a>
                </li>
            </ul>
        </nav>
    @show
    @env(['local', 'test'])
        <x-local :mode="App::environment()"/>
    @endenv

    @if(Auth::user() && !Auth::user()->email_verified_at)
        <x-alert type="danger" message="{{ __('Verify Your Email Address') }}">
            {{ __('If you did not receive the email') }},

            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
        </x-alert>
    @endif

            <h1 class="my-2">Primer ejemplo con Laravel</h1>

            <main>
                <h2>@yield('titulo')</h2>
                @includeWhen(Session::has('success'), 'layouts.success')
                @includeWhen($errors->any(), 'layouts.error')
                <p>Contamos con un catálogo de {{ $total }} anuncios.</p>
                @yield('contenido')
                <div class="btn-group" role="group" aria-label="Links">
                    @section('enlaces')
                        <a href="{{ url('/') }}" class="btn btn-primary m-2">Inicio</a>
                    @show
                </div>
            </main>
            <!-- FOOTER -->
            @section('pie')
            <footer class="page-footer font-small p-4 my-2 bg-light">
                <p>Aplicación creada por Carla Velasco como trabajo final del curso de Laravel.
                    Desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
            </footer>
        @show
@endsection

</html>
