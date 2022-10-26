@extends('layouts.master')

@section('contenido')
    <h2>Detalles de la moto {{"$ad->titulo"}}</h2>

    <table class="table table-striped table-bordered">
        <tr>
            <td>ID</td>
            <td>{{$ad->id}}</td>
        </tr>
        <tr>
            <td>titulo</td>
            <td>{{$ad->titulo}}</td>
        </tr>
        <tr>
            <td>descripcion</td>
            <td>{{$ad->descripcion}}</td>
        </tr>
        {{-- <tr>
            <td>Propietario</td>
            <td>{{$ad->user ? $ad->user->name : 'Sin propietario'}}</td>
        </tr> --}}
        <tr>
            <td>Precio</td>
            <td>{{$ad->precio}}</td>
        </tr>
        <tr>
            <td>Imagen</td>
            <td class="text-start">
                <img class="rounded" style="max-width: 400px"
                    alt="Imagen de {{ $ad->titulo }} {{ $ad->descripcion }}"
                    title="Imagen de {{ $ad->titulo }} {{ $ad->descripcion }}"
                    src="{{
                            $ad->imagen?
                            asset('storage/'.config('filesystems.adsImageDir')).'/'.$ad->imagen:
                            asset('storage/'.config('filesystems.adsImageDir')).'/default.jpg'
                        }}">
            </td>
        </tr>
    </table>
    <div class="text-end my-3">
        <div class="btn-group mx-2">
            @auth
                @if(Auth::user()->can('update', $ad))
                    <a href="{{route('ads.edit', $ad->id) }}" class="mx-2">

                        <img    src="{{asset('images/buttons/update.png')}}" alt="Modificar" title="Modificar"
                                height="40" width="40">
                    </a>
                @endif

                @if(Auth::user()->can('delete', $ad))
                    <a href="{{ route('ads.delete', $ad->id) }}" class="mx-2">

                        <img    src="{{asset('images/buttons/delete.png')}}" alt="Borrar" title="Borrar"
                                height="40" width="40">
                    </a>
                @endif
            @endauth
        </div>
    </div>

    <div class="btn-group" role="group" aria-label="Links">
        <a href="{{url('/')}}" class="btn btn-primary m-2">Inicio</a>
        <a href="{{route('ads.index')}}" class="btn btn-primary m-2">Garaje</a>
    </div>

    <img class="rounded" style="max-width: 400px"
                    alt="Imagen de {{ $ad->titulo }} {{ $ad->descripcion }}"
                    title="Imagen de {{ $ad->titulo }} {{ $ad->descripcion }}"
                    src="{{
                            $ad->imagen?
                            asset('storage/'.config('filesystems.adsImageDir')).'/'.$ad->imagen:
                            asset('storage/'.config('filesystems.adsImageDir')).'/default.jpg'
                        }}">
@endsection
