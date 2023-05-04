@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Usuario</h1>
@stop

@section('content')

    @include('admin.users.partials.form', [
        'action' => route('admin.users.update', $user),
        'roles' => $roles,
        'permissions' => Arr::undot( $permissions->pluck('id','name')->toArray() ),
        'user' => $user,
        'put' => true,
    ])

@stop
