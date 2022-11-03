@extends('layouts.master')

@section('contenido')
    <h2>Actualización del anuncio {{"$ad->marca $ad->modelo"}}</h2>

    <form action="{{route('ads.update', $ad->id)}}" class="my-2 border p-5" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <input name="_method" type="hidden" value="PUT">

        <div class="form-group row">
            <label for="inputTitulo" class="col-sm-2 col-form-label">titulo</label>
            <input  type="text" name="titulo" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{$ad->titulo}}">
        </div>

        <div class="form-group row">
            <label for="inputDescripcion" class="col-sm-2 col-form-label">descripcion</label>
            <input type="text" name="descripcion" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{$ad->descripcion}}">
        </div>

        <div class="form-group row">
            <label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
            <input type="number" name="precio" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{$ad->precio}}">
        </div>

        <div class="form-group row my-3">
            <div class="col-sm-9">
                <label for="inputImagen" class="col-sm-2 col-form-label">
                    {{ $ad->imagen ? 'Sustituir' : 'Añadir' }} imagen
                </label>
                <input type="file" name="imagen" class="form-control-file" id="inputImagen">

                @if($ad->imagen)
                <div class="form-check my-3">
                    <input type="checkbox" class="form-check-input"
                        name="eliminarimagen" id="inputEliminar">
                    <label for="inputEliminar" class="form-check-label">Eliminar imagen</label>
                </div>
                <script>
                    inputEliminar.onchange = function() {
                        inputImagen.disabled = this.checked;
                    }
                </script>
                @endif
            </div>
            <div class="col-sm-3">
                <label>Imagen actual:</label>
                <img class="rounded img-thumbnail my-3"
                        alt="Imagen de {{ $ad->marca }} {{ $ad->modelo }}"
                        title="Imagen de {{ $ad->marca }} {{ $ad->modelo }}"
                        src="{{
                            $ad->imagen ?
                            asset('storage/' . config('filesystems.adsImageDir')) . '/' . $ad->imagen :
                            asset('storage/' . config('filesystems.adsImageDir')) . '/default.jpg'
                        }}">
            </div>
        </div>

        <div class="form-group row">
            <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
            <button type="reset" class="btn btn-secondary m-2 mt-5">Borrar</button>
        </div>
    </form>

    <div class="text-end my-3">
        <div class="btn-group mx-2">
            <a href="{{route('ads.show', $ad->id) }}" class="mx-2">
                <img height="40" width="40" src="{{asset('images/buttons/show.png')}}"
                        alt="Borrar" title="Borrar">

            </a>
        </div>
    </div>


    <div class="btn-group" role="group" aria-label="Links">
        <a href="{{ url('/') }}" class="btn btn-primary m-2">Inicio</a>
        <a href="{{ route('ads.index') }}" class="btn btn-primary m-2">Garaje</a>
    </div>
@endsection
