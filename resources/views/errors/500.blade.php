@extends('adminlte::page')

@section('title', 'Error de servidor')

@section(auth()->check() ? 'content' : 'body')
    <div class="lockscreen-wrapper mt-0 pt-5" style="max-width: unset;">

        <div class="error-page mt-0 pt-5">
            <h2 class="headline text-danger">500</h2>
            <div class="error-content">
                <h3>Ups! Algo salió mal 😖</h3>
                <p class="text-center text-md-left">
                    Ha ocurrido un error en el servidor...
                    <br>
                    Intentaremos solucionarlo lo antes posible
                </p>
            </div>
        </div>

    </div>
@stop
