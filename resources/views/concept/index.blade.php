@extends('adminlte::page')

@section('title', 'Listado de recibos')

@section('content_header')
    <div class="d-flex">
        <div>
            <h1 class="m-0 text-dark">Listado de Conceptos</h1>
        </div>
        <a href="{{ $route_create }}" class="ml-auto">
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
                        @foreach ($concepts as $concept)
                            <tr>
                                <td>{{ $concept->id }}</td>
                                <td>{{ $concept->name }}</td>
                                <td>
                                    <a title="Editar" href="{{ route($str_route_edit, $concept) }}" class="btn btn-sm btn-warning py-0 px-1"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>

                </div>
            </div>
        </div>
    </div>
@stop
