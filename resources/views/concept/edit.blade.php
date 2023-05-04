@extends('adminlte::page')

@section('title', 'Editar Concepto')

@section('content_header')
    <div>
        <h1 class="m-0 text-dark">Editar Concepto</h1>
        <small>{{ $concept->name }}</small>
    </div>
@stop

@section('content')

 <form class="form-horizontal" action="{{ $action }}" method="POST">
    @csrf @method('PUT')
    <div class="card">
        <div class="card-body">

            <div class="row">
                <x-adminlte-input
                    value="{{ old('name', $concept->name) }}"
                    id="name"
                    name="name"
                    type="text"
                    label="Nombre"
                    fgroup-class="col-12"
                />
            </div>
       
        </div>

        <div class="card-footer d-flex">
            <x-adminlte-button class="ml-auto"
                label="Guardar"
                theme="primary"
                icon="fas fa-save"
                type="submit"
            />
        </div>
    </div>
</form>

@stop
