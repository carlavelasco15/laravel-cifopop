@extends('layouts.master')
@section('titulo', 'Contactar con LaraAds')
@section('contenido')
    <div class="container row">
        <form action="{{ route('contacto.email') }}" enctype="multipart/form-data"
            class="col-7 border p-4 my-2" method="POST">
            {{csrf_field()}}
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <input name="email" type="email" class="up form-control" id="inputEmail"
                    placeholder="Email" maxlength="255" required="required"
                    value="{{ old('email') }}">
            </div>
            <div class="form-group row">
                <label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
                <input type="text" name="nombre" class="up form-control"
                    id="inputNombre" placeholder="Nombre" maxlength="255" required="required"
                    value="{{ old('nombre') }}">
            </div>
            <div class="form-group row">
                <label for="inputAsunto" class="col-sm-2 col-form-label">Asunto</label>
                <input type="text" name="asunto" class="up-form-control"
                    id="inputAsunto" placeholder="Asunto" maxlength="255" required="required"
                    value="{{ old('asunto') }}">
            </div>
            <div class="form-group row">
                <label for="inputMensaje" class="col-sm-2 col-form-label">Mensaje</label>
                <textarea name="mensaje" id="inputMensaje" class="up form-control"
                    maxlength="2048" required="required">{{ old('mensaje') }}</textarea>
            </div>
            <div class="form-group row my-4">
                <label for="inputFichero" class="form-label">Fichero (pdf)</label>
                <input type="file" name="fichero" class="form-control-file"
                    accept="application/pdf" id="inputFichero">
            </div>
            <div class="form-group row">
                <button type="submit" class="btn btn-success m-2 mt-5">Enviar</button>
                <button type="reset" class="btn btn-secondary m-2 mt-5">Borrar</button>
            </div>
        </form>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2985.691208127571!2d2.058178890314522!3d41.5542827554959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a493650ae03931%3A0xee4ac6c8e8372532!2sCIFO%20Sabadell!5e0!3m2!1ses!2ses!4v1664979142243!5m2!1ses!2ses"
                style="border:0;min-width:300px;min-height:300px;width:40%" referrerpolicy="no-referrer-when-downgrade"
                allowfullscreen="" loading="lazy">
        </iframe>
    </div>

    @endsection

    @section('enlaces')
        @parent
        <a href="{{ route('ads.index') }}" class="btn btn-primary m-2">Garaje</a>
    @endsection
