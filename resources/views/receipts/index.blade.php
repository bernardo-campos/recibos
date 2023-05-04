@extends('adminlte::page')

@section('title', 'Listado de recibos')

@section('content_header')
    <div class="d-flex">
        <h1 class="m-0 text-dark">Listado de recibos</h1>
        <a href="{{ route('receipts.create') }}" class="ml-auto">
            <x-adminlte-button label="Nuevo" theme="success" icon="fas fa-plus"/>
        </a>
    </div>
@stop

@section('content')

    <form id="go-to-print" action="{{ route('receipts.print') }}" method="POST">
        @csrf
        <input type="hidden" name="ids" value="">
    </form>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('receipts.partials._datatable')
                    
                </div>
            </div>
        </div>
    </div>

    <x-adminlte-modal id="modal-email-text" title="Texto informar por email" class="text-center" size="lg">
        <div class="row">
            <div class="col-12">
                <pre id="email-text" class="text-sm text-muted text-left"></pre>
            </div>
        </div>
    </x-adminlte-modal>
@stop

@push('js')
<script type="text/javascript">

$(document).on('click', '.email-text-button', function () {
    $('#email-text').text($(this).attr('data-text'))
})

</script>
@endpush
