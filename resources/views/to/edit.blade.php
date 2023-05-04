@extends('adminlte::page')

@section('title', 'Editar campo "Destinatario"')

@section('content_header')
    <div>
        <h1 class="m-0 text-dark">Editar campo "Destinatario"</h1>
        {{ $to->name }}
    </div>
@stop

@section('content')

 <form class="form-horizontal" action="{{ route('tos.update', $to) }}" method="POST">
    @csrf @method('PUT')
    <div class="card">
        <div class="card-body">

            <div class="row">
                <x-adminlte-input
                    value="{{ old('name', $to->name) }}"
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

@push('js')
@endpush

@push('css')
@endpush