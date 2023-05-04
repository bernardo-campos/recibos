@extends('adminlte::page')

@section('title', 'Editar n° de secuencia')

@section('content_header')
    <h1 class="m-0 text-dark">Editar n° de secuencia de recibos</h1>
@stop

@section('content')
 <form class="form-horizontal" action="{{ route('sequence.update') }}" method="POST">
    @csrf @method('PUT')
    <div class="card">
        <div class="card-body">
            <div class="row">

                <x-adminlte-input
                    value="{{ $autoincrement_number }}"
                    name="autoincrement_number"
                    type="number"
                    label="Prox. N° (Actual: {{ $autoincrement_number }})"
                    fgroup-class="col-lg-4"
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
