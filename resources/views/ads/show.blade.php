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
        <tr>
            <td>Propietario</td>
            <td>{{$ad->user ? $ad->user->name : 'Sin propietario'}}</td>
        </tr>
        <tr>
            <td>Población</td>
            <td>{{$ad->user ? $ad->user->poblacion : 'Sin propietario'}}</td>
        </tr>
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

    <div class="my-4">
        <h2>Ofertas</h2>

        <form method="POST" action="{{ route('offers.store') }}">
            <div class="my-3 d-flex align-items-end">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                <div class="w-75">
                    <label>Mensaje</label>
                    <input class="up form-control" name= type="text" value="{{old('mensaje')}}">
                </div>
                <div class="ms-3">
                    <label>Oferta</label>
                    <input class="up form-control" name="descripcion" type="number" value="{{old('descripcion')}}">
                </div>
                <input class="btn btn-success ms-3" name="" type="submit" value="Ofertar">
            </div>
        </form>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Fecha</th>
            <th>Nombre ofertante</th>
            <th>Oferta</th>
            <th>Mensaje</th>
            <th>Acciones</th>
        </tr>
        <tr>
            <td>27/10/2022</td>
            <td>Dani</td>
            <td>5</td>
            <td>Esto es una mierda.</td>
            <td class="text-center d-flex justify-content-around">
                <a href="{{ route('ads.restore', $ad->id) }}">
                    <button class="btn btn-success">Aceptar</button>
                </a>
                <form method="POST" action="{{ route('ads.purgue') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                    <input type="submit" alt="Borrar" title="Rechazar"
                        class="btn btn-danger" value="Rechazar">
                </form>
            </td>
        </tr>
    </table>

    </div>
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
@endsection
