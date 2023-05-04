@extends('adminlte::page')

@section('title', 'Listado de Cuentas')

@section('content_header')
    <div class="d-flex">
        <div>
            <h1 class="m-0 text-dark">Listado de Cuentas</h1>
            <small></small>
        </div>
        <a href="{{ route('accounts.create') }}" class="ml-auto">
            <x-adminlte-button label="Nuevo" theme="success" icon="fas fa-plus"/>
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @php
                        $heads = ['#', 'Número de cuenta', 'Banco', 'Sucursal', ''];
                    @endphp

                    <x-adminlte-datatable class="table table-sm" id="table1" :heads="$heads">
                        @foreach ($accounts as $account)
                            <tr>
                                <td class="text-xs" width="20px">{{ $account->id }}</td>
                                <td>{{ $account->number }}</td>
                                <td>{{ $account->bank->name }}</td>
                                <td>{{ $account->branch }}</td>
                                <td width="50px">
                                    <a title="Editar" href="{{ route('accounts.edit', $account) }}" class="btn btn-sm btn-warning py-0 px-1"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
@endpush
