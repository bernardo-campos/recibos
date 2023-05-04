@extends('adminlte::page')
@section('plugins.NumeroALetras', true)

@section('title', 'Editar recibo #' . $receipt->id)

@section('content_header')
    <h1 class="m-0 text-dark">Editar recibo #{{ $receipt->id }}</h1>
@stop

@section('content')

 <form class="form-horizontal" action="{{ route('receipts.update', $receipt) }}" method="POST">
    @csrf @method('PUT')
    <div class="card">
        <div class="card-body">

            <div class="row">
                <x-adminlte-input
                    value="{{ old('date', $receipt->date->toDateString()) }}"
                    id="date"
                    name="date"
                    type="date"
                    label="Fecha"
                    fgroup-class="col-lg-2"
                />

                <x-adminlte-input
                    value="{{ old('date_string', $receipt->date_string) }}"
                    id="date_string"
                    name="date_string"
                    type="text"
                    label="Fecha (Texto)"
                    fgroup-class="col-lg-10"
                />
            </div>

            {{-- from --}}
            <div class="row">

                <x-adminlte-select2 
                    name="from_id"
                    label="De"
                    fgroup-class="col-lg-12 row mx-0 px-0"
                    label-class="col-lg-2 align-self-end"
                    igroup-class="col-lg-10"
                    >
                    @foreach ($froms as $from)
                        <option 
                            value="{{ $from->id }}"
                            {{ old('from_id', $receipt->from_id) == $from->id ? 'selected=""' : '' }}
                            >{{ $from->name }}</option>
                    @endforeach
                </x-adminlte-select2>
                
            </div>

            {{-- concept --}}
            <div class="row">

                <x-adminlte-select2 
                    name="concept_id"
                    label="En concepto de"
                    fgroup-class="col-lg-12 row mx-0 px-0"
                    label-class="col-lg-2 align-self-end"
                    igroup-class="col-lg-10"
                    >
                    @foreach ($concepts as $concept)
                        <option 
                            value="{{ $concept->id }}"
                            {{ old('concept_id', $receipt->concept_id) == $concept->id ? 'selected=""' : '' }}
                            >{{ $concept->name }}</option>
                    @endforeach
                </x-adminlte-select2>
                
            </div>

            {{-- type/bank/branch/account --}}
            <div class="row">
                <x-adminlte-select
                    name="type"
                    label="Forma de pago"
                    fgroup-class="col-lg-2">
                    <option value="1" @if(in_array(old('type', $receipt->type), ["1", "EFECTIVO"])) selected="" @endif>Efectivo</option>
                    <option value="2" @if(in_array(old('type', $receipt->type), ["2", "CHEQUE"])) selected="" @endif>Cheque</option>
                    <option value="3" @if(in_array(old('type', $receipt->type), ["3", "DEPÓSITO"])) selected="" @endif>Depósito</option>
                    <option value="4" @if(in_array(old('type', $receipt->type), ["4", "TRANSFERENCIA"])) selected="" @endif>Transferencia</option>
                    <option value="5" @if(in_array(old('type', $receipt->type), ["5", "OTRO"])) selected="" @endif>Otro</option>
                </x-adminlte-select>

                <x-adminlte-select2 
                    name="account_id"
                    label="N° Cuenta / Banco / Sucursal"
                    fgroup-class="col-lg-4">
                    <option value="">Ninguna</option>
                    @foreach ($accounts as $account)
                        <option 
                            value="{{ $account->id }}"
                            {{ old('account_id', $receipt->account->id) == $account->id ? 'selected=""' : '' }}
                            >{{ $account->number }} / {{ $account->bank->name }} / {{ $account->branch }}</option>
                    @endforeach
                </x-adminlte-select2>

                <x-adminlte-input
                    value="{{ old('amount_total', $receipt->amount_total) }}"
                    id="amount_total"
                    name="amount_total"
                    step="0.01"
                    min="0.00"
                    placeholder="0,00"
                    type="number"
                    label="TOTAL"
                    fgroup-class="col-lg-2"
                />
            </div>

            {{-- amount_total_words --}}
            <div class="row">

                <x-adminlte-input
                    value="{{ old('amount_total_words', $receipt->amount_total_words) }}"
                    id="amount_total_words"
                    name="amount_total_words"
                    type="text"
                    placeholder="Total (texto)"
                    fgroup-class="col-lg-6 offset-lg-6"
                />
            </div>

            {{-- note --}}
            <div class="row">
                <x-adminlte-input
                    value="{{ old('note', $receipt->note) }}"
                    name="note"
                    type="text"
                    label="Nota"
                    fgroup-class="col-lg-12 row mx-0 px-0"
                    label-class="col-lg-1 align-self-end"
                    igroup-class="col-lg-11"
                />
            </div>               
        </div>

        <div class="card-footer d-flex">
            <x-adminlte-button class="ml-auto"
                label="Guardar"
                theme="primary"
                icon="fas fa-save"
                type="submit"
            />
        </div>
    </div>
</form>

@stop

@push('js')
<script type="text/javascript">

    // Input: string in format 'yyyy-MM-dd'
    function newDatefromString(dateString){
      return new Date((dateString + " 00:00:00").replace(/-/g, "/"));
    }

    function dateToString(date) {
        return date.toLocaleDateString('es-AR', {year: 'numeric', month: 'long', day: 'numeric' });
    }

    String.prototype.letra = function() {
        let letras = NumeroALetras(this.valueOf()).toLowerCase();
        return letras
                .split(' ')
                .map( word => 
                        ["con","y"].includes(word) 
                                ? word 
                                : word.charAt(0).toUpperCase() + word.slice(1)
                        )
                .join(' ')
                .replace(/\s+/g, ' '); // <-- remove duplicate spaces
    };

    /* -------------------------------------------------------------------- */
    const dateElement = document.querySelector('#date');
    const dateStringElement = document.querySelector('#date_string');

    dateElement.addEventListener('change', (event) => {
        dateStringElement.value = dateToString( newDatefromString( event.target.value ) )
    });

    /* -------------------------------------------------------------------- */
    const amountTotal = document.querySelector('#amount_total')
    const amountTotalWords = document.querySelector('#amount_total_words')

    amountTotal.addEventListener('change', (event) => {
        amountTotalWords.value = "Pesos " + amountTotal.value.letra()
    });

    amountTotal.addEventListener('click', (event) => {
        event.srcElement.select()
    });


</script>
@endpush

@push('css')
<style type="text/css">
    .row .form-group {
        /*margin-bottom:  .5rem;*/
    }
</style>
@endpush