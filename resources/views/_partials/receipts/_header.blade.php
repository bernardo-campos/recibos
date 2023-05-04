<div class="col-5">
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
<div class="col-2">
	<h4 class="text-center fs-16-pt">
		<span class="fs-20-pt">RECIBO</span><br>
		<span class="fs-14-pt">{{ $original }}</span>
	</h4>
</div>
<div class="col-5 text-right d-flex flex-column">
	<h4 class="fs-16-pt">
		N°: {{ str_pad($receipt->id, 8, "0", STR_PAD_LEFT) }}
	</h4>
	<div style="margin-left: 7rem;">
		<div class="d-flex justify-content-between">
			<span>C.U.I.T.</span>
			<span>30-12345678-7</span>
		</div>
		<div class="d-flex justify-content-between">
			<span>Ing. Brutos</span>
			<span>Exento</span>
		</div>
		<div class="d-flex justify-content-between">
			<span>I.V.A.</span>
			<span>Exento</span>
		</div>
	</div>
</div>
