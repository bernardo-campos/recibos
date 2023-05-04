@extends('adminlte::page')

@section('title', 'Historial de actividades')

@section('content_header')
    <div class="d-flex">
        <div>
            <h1 class="m-0 text-dark">Historial de actividades</h1>
            <small></small>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('admin.log._datatable')

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
@endpush
