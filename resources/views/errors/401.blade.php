@extends ('layouts.master')
@section('titulo', 'Error 403')
@section('contenido')
    <div class="m-10">
        <div class="content" style="text-align: center">
            <div class="title mt-5" style="font-size: 3rem">
                ERROR 401: No autorizado :)
            </div>
            <div class="title mb-5" style="font-size: 2rem">
                {{ $exception->getMessage() }}
            </div>
        </div>
    </div>
@endsection

@section('enlaces')
    @parent
    <a href="{{ route('ads.index') }}" class="btn btn-primary m-2">Garaje</a>
@endsection
