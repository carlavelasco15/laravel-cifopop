@extends('layouts.master')

@section('contenido')
    <h2>Listado de motos</h2>

{{--
    <form method="GET" action="{{route('ads.search')}}" class="col-4 d-flex flex-row">
        {{csrf_field()}}
        <input name="marca" type="text" class="col form-control m-2"
                placeholder="Marca" maxlength="16" required
                value="{{empty($marca) ? '' : $marca}}">

        <input name="modelo" type="text" class="col form-control m-2"
                placeholder="Modelo" maxlength="16" required
                value="{{empty($modelo) ? '' : $modelo}}">
        <button type="submit" class="col btn btn-primary m-2">Buscar</button>
    </form> --}}

    <form action="{{route('ads.search')}}" class="col-6 row mb-2" method="GET">
        <input type="text" class="col form-control ms-2 mb-2" name="marca"
            placeholder="Marca" maxlength="16"
            value="{{ $marca ?? '' }}">

        <input type="text" class="col form-control ms-2 mb-2 ms-3" name="modelo"
            placeholder="Modelo" maxlength="16"
            value="{{ $modelo ?? '' }}">

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
            <th>Marca</th>
            <th>Modelo</th>
            <th>Matrícula</th>
            <th>Color</th>
            <th>Operaciones</th>
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
                                asset('storage/'.config('filesystems.bikesImageDir')).'/'.$ad->imagen:
                                asset('storage/'.config('filesystems.bikesImageDir')).'/default.jpg'
                            }}">
                </td>
                <td>{{ $ad->marca }}</td>
                <td>{{ $ad->modelo }}</td>
                <td>{{ $ad->matricula }}</td>
                <td style="background-color: {{ $ad->color }}">{{ $ad->color }}</td>
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
            <td colspan="4">No hay motos para mostrar</td>
        </tr>
        @endforelse
    </table>
    <div class="btn-group" role="group" label="Links">
        <a href="{{url('/')}}" class="btn btn-primary ms-2">Inicio</a>
    </div>
@endsection
