@extends('adminlte::page')

@section('title', 'Nuevo Colegio')

@section('content_header')
    <h1 class="m-0 text-dark">Nuevo Colegio</h1>
@stop

@section('content')

    @include('establishments._form', [
        'action' => route('establishments.store'),
        'establishment' => new App\Models\Establishment(),
    ])

@stop
