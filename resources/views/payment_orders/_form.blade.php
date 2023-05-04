<form class="form-horizontal" action="{{ $action }}" onsubmit="return confirm('{{ $onSubmitMessage }}')" method="POST">
    @csrf 
    @isset($is_put)
        @method('PUT')
    @endisset
    <div class="card">
        <div class="card-body">

            <div class="row">
                <x-adminlte-input
                    value="{{ old('date', $payment_order->date?->toDateString()) }}"
                    id="date"
                    name="date"
                    type="date"
                    label="Fecha"
                    fgroup-class="col-lg-2"
                />

                <x-adminlte-input
                    value="{{ old('date_string', $payment_order->date_string) }}"
                    id="date_string"
                    name="date_string"
                    type="text"
                    label="Fecha (Texto)"
                    fgroup-class="col-lg-10"
                />
            </div>

            {{-- to --}}
            <div class="row">

                <x-adminlte-select2
                    name="to_id"
                    label="Destinatario"
                    fgroup-class="col-lg-12 row mx-0 px-0"
                    label-class="col-lg-2 align-self-end"
                    igroup-class="col-lg-10"
                    >
                    <option value=""></option>
                    @foreach ($tos as $to)
                        <option
                            value="{{ $to->id }}"
                            {{ old('to_id', $payment_order->to_id) == $to->id ? 'selected=""' : '' }}
                            >{{ $to->name }}</option>
                    @endforeach
                </x-adminlte-select2>

            </div>

            {{-- establishment --}}
            <div class="row">

                <x-adminlte-select2
                    name="establishment_id"
                    label="Colegio"
                    fgroup-class="col-lg-12 row mx-0 px-0"
                    label-class="col-lg-2 align-self-end"
                    igroup-class="col-lg-10"
                    >
                    <option value=""></option>
                    @foreach ($establishments as $establishment)
                        <option
                            value="{{ $establishment->id }}"
                            {{ old('establishment_id', $payment_order->establishment_id) == $establishment->id ? 'selected=""' : '' }}
                            >{{ $establishment->name }}</option>
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
                    <option value=""></option>
                    @foreach ($concepts as $concept)
                        <option
                            value="{{ $concept->id }}"
                            {{ old('concept_id', $payment_order->concept_id) == $concept->id ? 'selected=""' : '' }}
                            >{{ $concept->name }}</option>
                    @endforeach
                </x-adminlte-select2>

            </div>

            {{-- invoice_number --}}
            <div class="row">
                <x-adminlte-input
                    value="{{ old('invoice_number', $payment_order->invoice_number) }}"
                    name="invoice_number"
                    type="text"
                    label="Factura/Ticket N°"
                    fgroup-class="col-lg-12 row mx-0 px-0"
                    label-class="col-lg-2 align-self-end"
                    igroup-class="col-lg-10"
                />
            </div>

            {{-- type/bank/branch/account --}}
            <div class="row">
                <x-adminlte-select
                    name="type"
                    label="Forma de pago"
                    fgroup-class="col-lg-2">
                    <option value=""></option>
                    <option value="1" @if(in_array(old('type', $payment_order->type), ["1", "EFECTIVO"])) selected="" @endif>Efectivo</option>
                    <option value="2" @if(in_array(old('type', $payment_order->type), ["2", "CHEQUE"])) selected="" @endif>Cheque</option>
                    <option value="3" @if(in_array(old('type', $payment_order->type), ["3", "DEPÓSITO"])) selected="" @endif>Depósito</option>
                    <option value="4" @if(in_array(old('type', $payment_order->type), ["4", "TRANSFERENCIA"])) selected="" @endif>Transferencia</option>
                    <option value="5" @if(in_array(old('type', $payment_order->type), ["5", "OTRO"])) selected="" @endif>Otro</option>
                </x-adminlte-select>

                <x-adminlte-select2
                    name="account_id"
                    label="N° Cuenta / Banco / Sucursal"
                    fgroup-class="col-lg-4">
                    <option value="">Ninguna</option>
                    @foreach ($accounts as $account)
                        <option
                            value="{{ $account->id }}"
                            {{ old('account_id', $payment_order->account->id) == $account->id ? 'selected=""' : '' }}
                            >{{ $account->number }} / {{ $account->bank->name }} / {{ $account->branch }}</option>
                    @endforeach
                </x-adminlte-select2>

                <x-adminlte-select
                    name="currency_id"
                    label="Moneda"
                    fgroup-class="col-lg-2">
                    @foreach ($currencies as $currency)
                        <option
                            value="{{ $currency->id }}"
                            data-name="{{ $currency->name }}"
                            @selected(old('currency_id', $payment_order->currency_id) == $currency->id)
                            >{{ $currency->name }} ({{ $currency->symbol }})</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-input
                    value="{{ old('amount_total', $payment_order->amount_total) }}"
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
                    value="{{ old('amount_total_words', $payment_order->amount_total_words) }}"
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
                    value="{{ old('note', $payment_order->note) }}"
                    name="note"
                    type="text"
                    label="Notas aclaratorias"
                    fgroup-class="col-lg-12 row mx-0 px-0"
                    label-class="col-lg-2 align-self-end"
                    igroup-class="col-lg-10"
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

    $('#amount_total, #currency_id').change(function (event) {
        let currency = $('#currency_id option:selected').attr('data-name')
        let amountTotalWords = $('#amount_total').val().letra()
        $('#amount_total_words').val(currency + " " + amountTotalWords)
    })

    $('#amount_total').on('click', function (event) {
        $(this).select();
    });


</script>
@endpush
