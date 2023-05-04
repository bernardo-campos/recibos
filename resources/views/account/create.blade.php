@extends('adminlte::page')

@section('title', 'Nueva Cuenta')

@section('content_header')
    <h1 class="m-0 text-dark">Nueva Cuenta</h1>
@stop

@section('content')

 <form class="form-horizontal" action="{{ route('accounts.store') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-body">

            <div class="row">
                <x-adminlte-input
                    value="{{ old('number') }}"
                    id="number"
                    name="number"
                    type="text"
                    label="Número de cuenta"
                    fgroup-class="col-lg-4"
                />

                <x-adminlte-select 
                    name="bank_id"
                    label="Banco"
                    fgroup-class="col-lg-4">
                    @foreach ($banks as $bank)
                        <option value="{{ $bank->id }}" {{ old('bank_id') == $bank->id ? 'selected=""' : ''}}
                        >{{ $bank->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-input
                    value="{{ old('branch') }}"
                    id="branch"
                    name="branch"
                    type="text"
                    label="Sucursal"
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

@push('js')
@endpush

@push('css')
@endpush
