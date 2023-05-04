@extends('_layouts.printing')

@section('title')
	@isset ($payment_order)
		Imprimir Orden de Pago #{{ $payment_order->id }}
	@else
		Imprimir {{ $payment_orders->count() }} Orden de Pagos
	@endisset
@endsection

@section('body')

	@isset ($payment_order)
		@include('_partials.payment_orders.a5', ['original' => ''])
	@else
		@foreach ($payment_orders as $payment_order)
			@include('_partials.payment_orders.a5', ['original' => ''])
		@endforeach
	@endisset

@endsection