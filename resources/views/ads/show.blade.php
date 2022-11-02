@extends('layouts.master')

@section('contenido')
    <h2>Detalles del anuncio {{"$ad->titulo"}}</h2>

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
            {{csrf_field()}}
            <div class="my-3 d-flex align-items-end">
                <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                <div class="w-75">
                    <label>Mensaje</label>
                    <input class="up form-control" name="mensaje" type="text" value="{{old('mensaje')}}">
                </div>
                <div class="ms-3">
                    <label>Oferta</label>
                    <input class="up form-control" name="precio" type="number" value="{{old('precio')}}">
                </div>
                <input class="btn btn-success ms-3" name="" type="submit" value="Ofertar">
            </div>
        </form>
    <table class="table table-striped table-bordered">
        <tr>
            <th class="text-center">Nombre ofertante</th>
            <th class="text-center">Oferta</th>
            <th class="text-center">Mensaje</th>
            <th class="text-center">Caducidad</th>
            <th class="text-center">Acciones</th>
        </tr>
        @forelse($offers as $offer)
        <tr>
            <td>{{ $offer->user ? $offer->user->name : 'Sin propietario' }}</td>
            <td class="text-center">{{ $offer->precio }} €</td>
            <td>{{ $offer->mensaje }}</td>
            <td class="text-center">{{ $offer->vigencia }}</td>
            <td class="text-center d-flex justify-content-around">
                <a href="{{ route('ads.restore', $ad->id) }}">
                </a>
                <form method="POST" action="{{ route('offers.accept') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                    <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                    <input type="hidden" name="user_id" value="{{ $offer->user_id }}">
                    <input type="submit" alt="Aceptar" title="Aceptar"
                        class="btn btn-success" value="Aceptar">
                </form>
                <form method="POST" action="{{ route('offers.refuse') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                    <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                    <input type="submit" alt="Borrar" title="Rechazar"
                        class="btn btn-danger" value="Rechazar">
                </form>
            </td>
        </tr>
            @if($loop->last)
                <tr>
                    <td colspan="7">Mostrando {{sizeof($offers)}} de {{$total}}.</td>
                </tr>
            @endif
        @empty
            <tr>
                <td colspan="7">El anuncio no tiene ofertas.</td>
            </tr>
        @endforelse
    </table>
    {{-- <div class="col-6 text-start">{{ $offers->links() }}</div> --}}

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
