@extends('_layouts.printing')

@section('title')
	@isset ($receipt)
		Imprimir Recibo #{{ $receipt->id }}
	@else
		Imprimir {{ $receipts->count() }} Recibos
	@endisset
@endsection

@section('body')

	@isset ($receipt)
		@include('_partials.receipts.a5', ['original' => 'ORIGINAL'])
		@include('_partials.receipts.a5', ['original' => 'DUPLICADO'])
	@else
		@foreach ($receipts as $receipt)
			@include('_partials.receipts.a5', ['original' => 'ORIGINAL'])
			@include('_partials.receipts.a5', ['original' => 'DUPLICADO'])
		@endforeach
	@endisset

@endsection