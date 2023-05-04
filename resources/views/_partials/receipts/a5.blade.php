<div class="invoice p-5">
	<div class="d-flex flex-column" style="border: 3px solid; border-radius: 1rem; padding: 2.5rem; height: 100%;">

		<div class="row">
			@include('_partials.receipts._header')
		</div>

		@include('_partials.receipts._body')

		<div class="row mt-auto text-right">
			@include('_partials.receipts._footer')
		</div>

	</div>
</div>
