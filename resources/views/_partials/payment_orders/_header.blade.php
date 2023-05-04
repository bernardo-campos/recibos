<div class="col-4 px-0">
	<h4 class="mb-0">
		<span class="fw-700 fs-16-pt">S.A.</span><br>
		<p class="fw-700 fs-13-pt mb-0" style="font-family: 'Arial Narrow';">
			NOMBRE EMPRESA
			<br>
			ORGANIZACIÓN
		</p>
	</h4>
	<small>
		<p class="m-0">
			Av. Colón (S) 121 * Tel/Fax (0385) 412-3456<br>
			(4200) SANTIAGO DEL ESTERO
		</p>
	</small>
</div>
<div class="col-4">
	<h4 class="text-center fs-16-pt">
		<span class="fs-20-pt">ORDEN DE PAGO</span><br>
		<span class="fs-14-pt">{{ $original }}</span>
	</h4>
</div>
<div class="col-4 px-0 text-right d-flex flex-column">
	<h4 class="fs-16-pt">
		N°: {{ str_pad($payment_order->id, 8, "0", STR_PAD_LEFT) }}
	</h4>
	<div class="mt-auto mb-3" style="margin-left: 3rem;">
		POR {{ $payment_order->currency->symbol }} <span class="font-weight-bold fs-16-pt">{{ number_format($payment_order->amount_total, 2,",",".") }}</span>
	</div>
</div>