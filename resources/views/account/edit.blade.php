@extends('adminlte::page')

@section('title', 'Editar Cuenta')

@section('content_header')
    <div>
        <h1 class="m-0 text-dark">Editar Cuenta</h1>
        <small>N° {{ $account->number }} / {{ $account->bank->name }} / {{ $account->branch }}</small>
    </div>
@stop

@section('content')

 <form class="form-horizontal" action="{{ route('accounts.update', $account) }}" method="POST">
    @csrf @method('PUT')
    <div class="card">
        <div class="card-body">

            <div class="row">
                <x-adminlte-input
                    value="{{ old('number', $account->number) }}"
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
                        <option value="{{ $bank->id }}" {{ old('bank_id', $account->bank->id) == $bank->id ? 'selected=""' : ''}}
                        >{{ $bank->name }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-input
                    value="{{ old('branch', $account->branch) }}"
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
