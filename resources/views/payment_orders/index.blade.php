@extends('adminlte::page')

@section('title', 'Listado de Órdenes de Pago')

@section('content_header')
    <div class="d-flex">
        <h1 class="m-0 text-dark">Listado de Órdenes de Pago</h1>
        <a href="{{ route('payment_orders.create') }}" class="ml-auto">
            <x-adminlte-button label="Nuevo" theme="success" icon="fas fa-plus"/>
        </a>
    </div>
@stop

@section('content')
    <form id="go-to-print" action="{{ route('payment_orders.print') }}" method="POST">
        @csrf
        <input type="hidden" name="ids" value="">
    </form>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('payment_orders.partials._datatable')

                </div>
            </div>
        </div>
    </div>
@stop
