<div class="mb-2">
    Mostrar/Ocultar:
    <a class="toggle-vis btn btn-link btn-sm" data-column="1">N°</a>
    <a class="toggle-vis btn btn-link btn-sm" data-column="2">Fecha</a>
    <a class="toggle-vis btn btn-link btn-sm" data-column="3">Destinatario</a>
    <a class="toggle-vis btn btn-link btn-sm" data-column="4">Factura</a>
    <a class="toggle-vis btn btn-link btn-sm" data-column="5">Concepto</a>
    <a class="toggle-vis btn btn-link btn-sm" data-column="6">Colegio</a>
    <a class="toggle-vis btn btn-link btn-sm" data-column="7">Total</a>
    <a class="toggle-vis btn btn-link btn-sm" data-column="8">Tipo</a>
    <a class="toggle-vis btn btn-link btn-sm" data-column="9">Banco</a>
    <a class="toggle-vis btn btn-link btn-sm" data-column="10">Sucursal</a>
    <a class="toggle-vis btn btn-link btn-sm" data-column="11">Cta N°</a>
    <a class="toggle-vis btn btn-link btn-sm" data-column="12">Notas</a>
</div>
<hr>
<table class="table table-sm dt-responsive" id="payment_orders_table">
<thead>
    <tr>
        <th></th> <!-- [select checkbox] -->
        <th>N°</th>
        <th>Fecha</th>
        <th>Destinatario</th>
        <th>Factura</th>
        <th>Concepto</th>
        <th>Colegio</th>
        <th>Total</th>
        <th>Tipo</th>
        <th>Banco</th>
        <th>Sucursal</th>
        <th>Cta N°</th>
        <th>Notas</th>
        <th></th> <!-- [opciones] -->
    </tr>
</thead>
<tbody></tbody>
</table>

@push('js')
<script type="text/javascript">

var payment_orders_table = $('#payment_orders_table').DataTable( {
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
    },
    order: [[1, 'desc']],
    stateSave: true,
    processing: true,
    serverSide: true,
    ajax: '{{ route('payment_orders.index') }}',
    search: {
        return: true,
    },
    columnDefs: [ {
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    } ],
    buttons: [
        // 'selected',
        {
            extend: 'selected',
            text: 'Imprimir',
            action: function ( e, dt, button, config ) {
                $('#go-to-print').submit()
            }
        },
        {
            extend: 'selectAll',
            text: 'Seleccionar todas'
        },
        {
            extend: 'selectNone',
            text: 'Deseleccionar todas'
        }
    ],
    select: {
        style:    'multi',
        selector: 'td:first-child'
    },
    dom: 'Blfrtip',
    columns: [
        {
            data: null,
            defaultContent: '',
            orderable: false
        },
        {
            data: 'id', name: 'id'
        },
        {
            data: 'date',
            name: 'date',
            render: $.fn.dataTable.render.moment("YYYY-MM-DDTHH:mm:ss.SSSSSSZ", 'DD/MM/YYYY')
        },
        {
            data: 'to.name',
            name: 'to.name'
        },
        {
            data: 'invoice_number',
            name: 'invoice_number'
        },
        {
            data: 'concept.name',
            name: 'concept.name'
        },
        {
            data: 'establishment.name',
            name: 'establishment.name'
        },
        {
            data: 'amount_total',
            name: 'amount_total'
        },
        {
            data: 'type',
            name: 'type'
        },
        {
            data: 'account.bank.name',
            name: 'account.bank.name',
            defaultContent: ''
        },
        {
            data: 'account.branch',
            name: 'account.branch',
            defaultContent: ''
        },
        {
            data: 'account.number',
            name: 'account.number',
            defaultContent: ''
        },
        {
            data: 'note',
            name: 'note'
        },
        {
            data: null,
            defaultContent: '',
            orderable: false,
            render: function ( data, type, row, meta ) {
                let anchor_show = `<a title="Mostrar" href="${row.urls.show}" class="btn btn-sm btn-warning py-0 px-1"><i class="fa fa-eye"></i></a>`;
                let anchor_edit = `<a title="Mostrar" href="${row.urls.edit}" class="btn btn-sm btn-warning py-0 px-1 ml-1"><i class="fa fa-edit"></i></a>`;
                if (type === 'display') {
                    return `<div class="d-flex">${anchor_show + anchor_edit}</div>`;
                }
            }
        },
    ],
} );

payment_orders_table
    .on( 'select', function ( e, dt, type, indexes ) {
        console.log(dt)
        $('input[name=ids]').val( dt.rows({selected:true}).data().pluck('id').join() )
        payment_orders_table.buttons('.buttons-selected').text(`Imprimir (${dt.rows({selected:true}).count()})`)
    } )
    .on( 'deselect', function ( e, dt, type, indexes ) {
        $('input[name=ids]').val( dt.rows({selected:true}).data().pluck('id').join() )
        payment_orders_table.buttons('.buttons-selected').text(`Imprimir (${dt.rows({selected:true}).count()})`)
    } );

$('a.toggle-vis').on('click', function (e) {
    e.preventDefault();

    // Get the column API object
    var column = payment_orders_table.column($(this).attr('data-column'));
    $(this).toggleClass('line-through')

    // Toggle the visibility
    column.visible(!column.visible());
});

payment_orders_table.columns().every( function(index) {
    $(`a[data-column=${index}]`).addClass(!payment_orders_table.column(index).visible() ? 'line-through' : '');
});

</script>
@endpush

@push('css')
<style>
    table {
        width: 100%!important;
    }
    table.dataTable td:nth-last-child(2) {
        word-break: break-word;
    }
    .line-through {
        text-decoration: line-through;
    }

    #payment_orders_table_wrapper .dt-buttons {
        float: none;
        display: inline-block;
        margin-left: 1rem;
    }
    #payment_orders_table_length {
        float: left;
    }
    #payment_orders_table_length label {
        margin-top: 0.5rem;
    }
</style>
@endpush