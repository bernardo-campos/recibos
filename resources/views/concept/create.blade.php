@extends('adminlte::page')

@section('title', 'Nuevo concepto')

@section('content_header')
    <h1 class="m-0 text-dark">Nuevo concepto</h1>
@stop

@section('content')

 <form class="form-horizontal" action="{{ $action }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-body">

            <div class="row">
                <x-adminlte-input
                    value="{{ old('name') }}"
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
