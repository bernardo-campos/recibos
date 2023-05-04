<div class="row mt-auto text-center">
	{{-- <div class="offset-8 col-4 fs-12-pt"></div> --}}
	
	<div class="col-4 fs-10-pt mb-3">
		<span class="line-top">AUTORIZADO</span>
	</div>
	<div class="col-4 fs-10-pt mb-3">
		<span class="line-top">RECIBIDO</span>
	</div>
	<div class="col-4 fs-10-pt mb-3">
		<span class="line-top">SOLICITADO</span>
	</div>

	<div class="col-12 d-flex align-items-end mb-1">
		<small>
			O.P. emitida por {{ $payment_order->user->name }}
		</small>
	</div>

</div>

@once
@push('css')
<style type="text/css">
	.line-top {
		border-top: 1px solid;
    	padding: 5px 20px;
	}
</style>
@endpush
@endonce