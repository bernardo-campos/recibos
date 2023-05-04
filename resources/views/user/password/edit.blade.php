@extends('adminlte::page')

@section('title', 'Actualizar contraseña')

@section('content_header')
    <div>
        <h1 class="m-0 text-dark">Actualizar contraseña</h1>
    </div>
@stop

@section('content')

 <form class="form-horizontal" action="{{ route('user.password') }}" method="POST">
    @csrf @method('PUT')
    <div class="card">
        <div class="card-body">

            <div class="row">
                <x-adminlte-input
                    value="{{ old('current_password') }}"
                    id="current_password"
                    name="current_password"
                    type="password"
                    label="Contraseña actual"
                    fgroup-class="col-12"
                />
            </div>

            <div class="row">
                <x-adminlte-input
                    value="{{ old('password') }}"
                    id="password"
                    name="password"
                    type="password"
                    label="Nueva contraseña"
                    fgroup-class="col-12"
                />
            </div>

            <div class="row">
                <x-adminlte-input
                    value="{{ old('password_confirmation') }}"
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    label="Repetir contraseña"
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