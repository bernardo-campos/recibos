@extends('adminlte::page')

@section('title', 'Error 404 | Sitio no encontrado')

@section(auth()->check() ? 'content' : 'body')
    <div class="lockscreen-wrapper mt-0 pt-5" style="max-width: unset;">

        <div class="error-page mt-0 pt-5">
            <h2 class="headline text-danger">404</h2>
            <div class="error-content">
                <h3>Ups! Recurso no encontrado 🤷‍</h3>
                <p class="text-center text-md-left">
                    Es posible que la página a la que desea acceder haya cambiado de dirección.
                    <br>
                    <a href="/">Haga clic aquí</a> para ir a la página principal
                </p>
            </div>
        </div>

    </div>
@stop
