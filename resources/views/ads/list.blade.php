@extends('layouts.master')

@section('contenido')
    <h2>Listado de anuncios</h2>

    <form action="{{route('ads.search')}}" class="col-6 row mb-2" method="GET">
        <input type="text" class="col form-control ms-2 mb-2" name="descripcion"
            placeholder="descripcion" maxlength="16"
            value="{{ $descripcion ?? '' }}">

        <input type="text" class="col form-control ms-2 mb-2 ms-3" name="titulo"
            placeholder="titulo" maxlength="16"
            value="{{ $titulo ?? '' }}">

        <button type="submit" class="col btn btn-primary ms-2 mb-2 ms-3">Buscar</button>

        <a href="{{ route('ads.index') }}" class="col btn btn-primary mb-2 ms-3" >
                Quitar filtro
        </a>
    </form>

    @auth
        <div class="row">
            <div class="col-6 text-start">{{ $ads->links() }}</div>
            <div class="col-6 text-end">
                <p> Nueva moto <a class="btn btn-success ml-2" href="{{route('ads.create')}}">+</a></p>
            </div>
        </div>
    @endauth

    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>descripcion</th>
            <th>Titulo</th>
            <th>Precio</th>
            <th>Operaciones</th>
        </tr>

        @forelse($ads as $ad)
            <tr>
                <td>{{ $ad->id }}</td>
                <td class="text-center" style="max-width: 80px">
                    <img class="rounded" style="max-width: 80%"
                        alt="Imagen de {{$ad->descripcion}} {{$ad->titulo}}"
                        title="Imagen de {{$ad->descripcion}} {{$ad->titulo}}"
                        src="{{
                                $ad->imagen?
                                asset('storage/'.config('filesystems.adsImageDir')).'/'.$ad->imagen:
                                asset('storage/'.config('filesystems.adsImageDir')).'/default.jpg'
                            }}">
                </td>
                <td>{{ $ad->descripcion }}</td>
                <td>{{ $ad->titulo }}</td>
                <td>{{ $ad->precio }}</td>
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
            @if($loop->last)
            <tr>
                <td colspan="4">Mostrando {{sizeof($ads)}} de {{$total}}.</td>
            </tr>
            @endif
        @empty
        <tr>
            <td colspan="4">No hay anuncios para mostrar</td>
        </tr>
        @endforelse
    </table>


    <div class="btn-group" role="group" label="Links">
        <a href="{{url('/')}}" class="btn btn-primary ms-2">Inicio</a>
    </div>
@endsection

