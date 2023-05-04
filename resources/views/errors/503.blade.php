@extends('adminlte::page')

@section('title', 'Sitio en mantenimiento')

@section(auth()->check() ? 'content' : 'body')
    <div class="lockscreen-wrapper mt-0 pt-5" style="max-width: unset;">

        <div class="error-page mt-0 pt-5">
            <h2 class="headline text-warning">503</h2>
            <div class="error-content">
                <h3>Ups! El sitio no está disponible 😳</h3>
                <p class="text-center text-md-left">
                    Estamos realizando tareas de mantenimiento...
                    <br>
                    Por favor, intenta de nuevo más tarde
                </p>
            </div>
        </div>

    </div>
@stop
