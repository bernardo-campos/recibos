<div class="offset-8 col-4 fs-12-pt">
	<table class="table table-sm fs-14-pt mb-0">
		<tr>
			<td>TOTAL</td>
			<td>$ {{ number_format($receipt->amount_total, 2,",",".") }}</td>
		</tr>
	</table>
</div>
<div class="col-12">
	<p></p>
</div>
<div class="col-12 d-flex align-items-end mb-1">
	<small>
		Recibo emitido por {{ $receipt->user->name }}
	</small>
</div>
