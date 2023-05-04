@extends('adminlte::page')

@section('title', 'Nuevo Usuario')

@section('content_header')
    <h1 class="m-0 text-dark">Nuevo Usuario</h1>
@stop

@section('content')

    @include('admin.users.partials.form', [
        'action' => route('admin.users.store'),
        'roles' => $roles,
        'permissions' => Arr::undot( $permissions->pluck('id','name')->toArray() ),
        'user' => new App\Models\User(),
    ])

@stop
