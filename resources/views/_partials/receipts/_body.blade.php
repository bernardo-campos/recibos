<div class="row">
	<div class="col-12 text-right fs-12-pt mt-4">
		<br>
		Santiago del Estero, {{ $receipt->date_string }}
	</div>
</div>

<div class="row mt-1">
	<div class="col-12 fs-14-pt mt-4">
		Recibimos de <span>{{ $receipt->from->name }}</span> la suma de {{ $receipt->amount_total_words }} en concepto de {{ $receipt->concept->name }}
		<br>
		Por medio de {{ $receipt->type }}
		@if ($receipt->account->id)
			c/Bco. {{ $receipt->account->bank->name }} Suc. {{ $receipt->account->branch }} N° {{ $receipt->account->number }}
		@endif
		<br>
		Nota: {{ $receipt->note }}
	</div>
</div>
