@extends('adminlte::page')

@section('title', 'Listado de proveedores/colegios')

@section('content_header')
    <div class="d-flex">
        <div>
            <h1 class="m-0 text-dark">Listado de proveedores/colegios</h1>
            <small>Los que aparecen en este listado estarán disponibles en el campo "DE" al momento de crear un Recibo</small>
        </div>
        <a href="{{ route('froms.create') }}" class="ml-auto">
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
                        $heads = ['#','Nombre',''];
                    @endphp

                    <x-adminlte-datatable class="table table-sm" id="table1" :heads="$heads">
                        @foreach ($froms as $from)
                            <tr>
                                <td>{{ $from->id }}</td>
                                <td>{{ $from->name }}</td>
                                <td>
                                    <a title="Editar" href="{{ route('froms.edit', $from) }}" class="btn btn-sm btn-warning py-0 px-1"><i class="fa fa-edit"></i></a>
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
