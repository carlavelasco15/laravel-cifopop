@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="m-2">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>{{ __('You are logged in!') }}</p>
                    <p><span class="fw-bold">Nom d'usuari:</span> {{Auth::user()->name}}</p>
                    <p><span class="fw-bold">Email:</span> {{Auth::user()->email}}</p>
                    @if(Auth::user()->location)
                        <p><span class="fw-bold">Location:</span> {{Auth::user()->location}}</p>
                    @endif
                </div>
            </div>


            <h3 class="mt-5">Mis anuncios</h3>
            <table class="table table-striped table-bordered my-3">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Titulo</th>
                    <th>Precio</th>
                    <th>Descripcion</th>
                    <th>Opciones</th>
                </tr>

                @forelse($ads as $ad)
                    <tr>
                        <td>{{ $ad->id }}</td>
                        <td class="text-center" style="max-width: 80px">
                            <img class="rounded" style="max-width: 80%"
                                alt="Imagen de {{$ad->marca}} {{$ad->modelo}}"
                                title="Imagen de {{$ad->marca}} {{$ad->modelo}}"
                                src="{{
                                        $ad->imagen?
                                        asset('storage/'.config('filesystems.adsImageDir')).'/'.$ad->imagen:
                                        asset('storage/'.config('filesystems.adsImageDir')).'/default.jpg'
                                    }}">
                        </td>
                        <td>{{ $ad->titulo }}</td>
                        <td>{{ $ad->precio }}</td>
                        <td>{{ $ad->descripcion }}</td>
                        <td class="text-center">
                            <a href="{{route('ads.show', $ad->id)}}">
                                <img    src="{{asset('images/buttons/show.png')}}"
                                        alt="Ver detalles" title="Ver detalles"
                                        height="20" width="20">
                            </a>
                            @auth
                                @if(Auth::user()->can('update', $ad))
                                    <a href="{{route('ads.edit', $ad->id)}}">
                                        <img    src="{{asset('images/buttons/update.png')}}"
                                                alt="Modificar" title="Modificar"
                                                height="20" width="20">
                                    </a>
                                @endif

                                @if(Auth::user()->can('delete', $ad))
                                    <a href="{{route('ads.delete', $ad->id)}}">
                                        <img    src="{{asset('images/buttons/delete.png')}}"
                                                alt="Borrar" title="Borrar"
                                                height="20" width="20">
                                    </a>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="7">No hay anuncios para mostrar</td>
                </tr>
                @endforelse
            </table>



            <h3 class="mt-5">Anuncios borrados</h3>
            <table class="table table-striped table-bordered my-3">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Titulo</th>
                    <th>Precio</th>
                    <th>Descripcion</th>
                </tr>

                @forelse($deletedAds as $ad)
                    <tr>
                        <td>{{ $ad->id }}</td>
                        <td class="text-center" style="max-width: 80px">
                            <img class="rounded" style="max-width: 80%"
                                alt="Imagen de {{$ad->marca}} {{$ad->modelo}}"
                                title="Imagen de {{$ad->marca}} {{$ad->modelo}}"
                                src="{{
                                        $ad->imagen?
                                        asset('storage/'.config('filesystems.adsImageDir')).'/'.$ad->imagen:
                                        asset('storage/'.config('filesystems.adsImageDir')).'/default.jpg'
                                    }}">
                        </td>
                        <td>{{ $ad->marca }}</td>
                        <td>{{ $ad->modelo }}</td>
                        <td>{{ $ad->matricula }}</td>
                        <td style="background-color: {{ $ad->color }}">{{ $ad->color }}</td>
                        <td class="text-center d-flex justify-content-around">
                            <a href="{{ route('ads.restore', $ad->id) }}">
                                <button class="btn btn-success">Restaurar</button>
                            </a>
                            <form method="POST" action="{{ route('ads.purgue') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                                <input type="submit" alt="Borrar" title="Eliminar"
                                    class="btn btn-danger" value="Eliminar">
                            </form>
                        </td>
                    </tr>
                    @if($loop->last)
                    <tr>
                        <td colspan="7">Mostrando {{sizeof($ads)}} de {{$total}}.</td>
                    </tr>
                    @endif
                @empty
                <tr>
                    <td colspan="7">No hay anuncios para mostrar</td>
                </tr>
                @endforelse
            </table>





            <h3 class="mt-5">Mis ofertas activas</h3>
            <table class="table table-striped table-bordered my-3">
                <tr>
                    <th>Anuncio</th>
                    <th>Precio</th>
                    <th>Mensaje</th>
                    <th>Valido hasta</th>
                </tr>

                @forelse($myOffers as $offer)
                    <tr>
                        <td>{{ $offer->ad->titulo }}</td>
                        <td>{{ $offer->precio }}</td>
                        <td>{{ $offer->mensaje }}</td>
                        <td>{{ $offer->vigencia }}</td>
                    </tr>
                @empty
                <tr>
                    <td colspan="7">No tienes ofertas activas</td>
                </tr>
                @endforelse
            </table>



            <h3 class="mt-5">Historial de ofertas a mis anuncios</h3>
            <table class="table table-striped table-bordered my-3">
                <tr>
                    <th>Anuncio</th>
                    <th>Precio Ofertado</th>
                    <th>Precio Original</th>
                    <th>Estado</th>
                    <th>Mensaje</th>
                    <th>Valido hasta</th>
                </tr>

                @forelse($someonesOffers as $offer)
                    <tr>
                        <td>{{ $offer->ad->titulo }}</td>
                        <td>{{ $offer->precio }}</td>
                        <td>{{ $offer->ad->precio }}</td>
                        <td>{{ $offer->rechazada ? 'RECHAZADA' : ($offer->aceptada ? 'ACEPTADA' : 'PENDIENTE RESPUESTA') }}</td>
                        <td>{{ $offer->mensaje }}</td>
                        <td>{{ $offer->vigencia }}</td>
                    </tr>
                @empty
                <tr>
                    <td colspan="7">No tienes ofertas activas</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
@endsection
