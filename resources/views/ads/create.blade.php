@extends('layouts.master')

@section('titulo', 'Nueva Moto')

@section('contenido')

    <form action="{{route('ads.store')}}" enctype="multipart/form-data" class="my-2 border p-5" method="POST">
        {{csrf_field()}}

        <div class="form-group row">
            <label for="inputTitulo" class="col-sm-2 col-form-label">Titulo</label>
            <input  type="text" name="titulo" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{old('titulo')}}">
        </div>

        <div class="form-group row">
            <label for="inputDescripcion" class="col-sm-2 col-form-label">Descripcion</label>
            <input  type="text" name="descripcion" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{old('descripcion')}}">
        </div>

        <div class="form-group row">
            <label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
            <input type="number" name="precio" class="up form-control col-sm-10"
                    maxlenght="255" required="required" value="{{old('precio')}}">
        </div>

        <div class="form-group row">
            <label for="inputImagen" class="col-sm-2 col-form-label">Imagen</label>
            <input type="file" name="imagen" class="form-control-file col-sm-10" id="inputImagen">
        </div>

        <div class="form-group row">
            <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
            <button type="reset" class="btn btn-secondary m-2 mt-5">Borrar</button>
        </div>
    </form>
@endsection

@section('enlaces')
    @parent
    <a href="{{route('ads.index')}}" class="btn btn-primary m-2">Garaje</a>
@endsection
