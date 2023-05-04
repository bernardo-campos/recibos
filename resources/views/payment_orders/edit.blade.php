@extends('adminlte::page')
@section('plugins.NumeroALetras', true)

@section('title', 'Editar Órden de pago #' . $payment_order->id)

@section('content_header')
    <h1 class="m-0 text-dark">Editar Órden de pago #{{ $payment_order->id }}</h1>
@stop

@section('content')

    @include('payment_orders._form', [
        'action' => route('payment_orders.update', $payment_order),
        'onSubmitMessage' => 'Se modificará la Órden de pago. ¿Continuar?',
        'payment_order' => $payment_order,
        'is_put' => true,
    ])

@stop
