<div class="row">
	<div class="col-12 text-right fs-12-pt mt-0">
		<br>
		Santiago del Estero, {{ $payment_order->date_string }}
	</div>
</div>

<div class="row mt-1">
	<div class="col-12 fs-14-pt mt-4">
		PÁGUESE a <span>{{ $payment_order->to->name }}</span>, Factura/Ticket N° {{ $payment_order->invoice_number }}
		<br>
		{{ $payment_order->amount_total_words }}
		<br>
		En concepto de {{ $payment_order->concept->name }}
		<br>
		Por cuenta de: {{ $payment_order->establishment->name }}
		<br>
		Por medio de {{ $payment_order->type }}
		@if ($payment_order->account->id)
			Bco. {{ $payment_order->account->bank->name }} Suc. {{ $payment_order->account->branch }} N° {{ $payment_order->account->number }}
		@endif
		<br>
		@if ($payment_order->note)
			Notas aclaratorias: {{ $payment_order->note }}
		@endif
	</div>
</div>
