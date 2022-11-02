@extends('layouts.master')

@section('titulo', "Confirmación de borrado de $ad->marca $ad->modelo")

@section('contenido')
    <form  class="my-2 border p-5" method="POST"
            action="{{URL::temporarySignedRoute('ads.destroy', now()->addMinutes(1), $ad->id)}}">
        {{ csrf_field() }}
        <input type="hidden" value="DELETE" name="_method">
        <figure>
            <figcaption>Imagen actual</figcaption>
            <img src="{{ $ad->imagen ?
                        asset('storage/' . config('filesystems.adsImageDir')) . '/'.$ad->imagen:
                        asset('storage/' . config('filesystems.adsImageDir')) . '/default.jpg' }}"
                title="Imagen de {{ $ad->marca }} {{ $ad->modelo }}"
                alt="Imagen de {{ $ad->marca }} {{ $ad->modelo }}"
                class="rounded" style="max-width: 400px">
        </figure>

        <label for="confirmdelete">Confirma el borrado de {{"$ad->marca $ad->modelo"}}</label>
        <input type="submit" class="btn btn-danger m-4" alt="Borrar" title="Borrar"
                value="Borrar" id="confirmdelete">
    </form>
@endsection

@section('enlaces')
    @parent
        <div href="{{route('ads.index')}}" class="btn btn-primary m-2">Garaje</div>
        <div href="{{route('ads.show', $ad->id)}}" class="btn btn-primary m-2">Regresar a detalles del anuncio</div>
@endsection
