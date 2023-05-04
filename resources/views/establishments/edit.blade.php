@extends('adminlte::page')

@section('title', 'Editar Colegio')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Colegio</h1>
@stop

@section('content')

    @include('establishments._form', [
        'action' => route('establishments.update', $establishment),
        'establishment' => $establishment,
        'is_put' => true,
    ])

@stop
