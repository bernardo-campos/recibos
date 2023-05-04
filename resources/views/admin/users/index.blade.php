@extends('adminlte::page')

@section('title', 'Listado de Usuarios del sistema')

@section('content_header')
    <div class="d-flex">
        <div>
            <h1 class="m-0 text-dark">Listado de usuarios del sistema</h1>
            <small></small>
        </div>
        <a href="{{ route('admin.users.create') }}" class="ml-auto">
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
                        $heads = [
                            [
                                'label' => '#',
                                'width' => '15px'
                            ],
                            'DNI',
                            'Nombre',
                            'Roles',
                            'Creado',
                            'Modificado',
                            'Password personal',
                            ''
                        ];
                    @endphp

                    <x-adminlte-datatable class="table table-sm" id="table1" :heads="$heads">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->dni }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>{{ $user->hasCustomPassword() }}</td>
                                <td>
                                    <a title="Editar" href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning py-0 px-1"><i class="fa fa-edit"></i></a>
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
