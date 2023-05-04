@extends('adminlte::page')
@section('plugins.NumeroALetras', true)

@section('title', 'Nueva Órden de Pago')

@section('content_header')
    <h1 class="m-0 text-dark">Nueva Órden de Pago</h1>
@stop

@section('content')

    @include('payment_orders._form', [
        'action' => route('payment_orders.store'),
        'onSubmitMessage' => 'Se creará la nueva Órden de pago. ¿Continuar?',
        'payment_order' => new App\Models\PaymentOrder(),
    ])

@stop
