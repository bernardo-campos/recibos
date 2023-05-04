<div class="mb-2">
    Mostrar/Ocultar:
    <a class="toggle-vis btn btn-link btn-sm" data-column="1">N°</a> -
    <a class="toggle-vis btn btn-link btn-sm" data-column="2">Fecha</a> -
    <a class="toggle-vis btn btn-link btn-sm" data-column="3">De</a> -
    <a class="toggle-vis btn btn-link btn-sm" data-column="4">Concepto</a> -
    <a class="toggle-vis btn btn-link btn-sm" data-column="5">Total</a> -
    <a class="toggle-vis btn btn-link btn-sm" data-column="6">Tipo</a> -
    <a class="toggle-vis btn btn-link btn-sm" data-column="7">Banco</a> -
    <a class="toggle-vis btn btn-link btn-sm" data-column="8">Sucursal</a> -
    <a class="toggle-vis btn btn-link btn-sm" data-column="9">Cta N°</a> -
    <a class="toggle-vis btn btn-link btn-sm" data-column="10">Nota</a>
</div>
<hr>
<table class="table table-sm dt-responsive" id="receipts_table">
<thead>
    <tr>
        <th></th>
        <th>N°</th>
        <th>Fecha</th>
        <th>De</th>
        <th>Concepto</th>
        <th>Total</th>
        <th>Tipo</th>
        <th>Banco</th>
        <th>Sucursal</th>
        <th>Cta N°</th>
        <th>Nota</th>
        <th></th>
    </tr>
</thead>
<tbody></tbody>
</table>

@push('js')
<script type="text/javascript">

var receipts_table = $('#receipts_table').DataTable( {
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
    },
    order: [[1, 'desc']],
    stateSave: true,
    processing: true,
    serverSide: true,
    ajax: '{{ route('receipts.index') }}',
    search: {
        return: true,
    },
    columnDefs: [ {
        orderable: false,
        className: 'select-checkbox',
        targets:   0
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
            data: 'from.name',
            name: 'from.name'
        },
        {
            data: 'concept.name',
            name: 'concept.name'
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
                let anchor_edit = `<a title="Editar" href="${row.urls.edit}" class="btn btn-sm btn-warning py-0 px-1 ml-1"><i class="fa fa-edit"></i></a>`;
                let email_msg_btn = `<button
                    data-toggle="modal"
                    data-target="#modal-email-text"
                    title="Ver texto email"
                    data-text="${row.email_text}"
                    class="btn btn-sm btn-warning py-0 px-1 ml-1 email-text-button"
                    ><i class="fa fa-at"></i></button>`;
                if (type === 'display') {
                    return `<div class="d-flex">${anchor_show + anchor_edit + email_msg_btn}</div>`;
                }
            }
        },
    ],
} );

receipts_table
    .on( 'select', function ( e, dt, type, indexes ) {
        console.log(dt)
        $('input[name=ids]').val( dt.rows({selected:true}).data().pluck('id').join() )
        receipts_table.buttons('.buttons-selected').text(`Imprimir (${dt.rows({selected:true}).count()})`)
    } )
    .on( 'deselect', function ( e, dt, type, indexes ) {
        $('input[name=ids]').val( dt.rows({selected:true}).data().pluck('id').join() )
        receipts_table.buttons('.buttons-selected').text(`Imprimir (${dt.rows({selected:true}).count()})`)
    } );

$('a.toggle-vis').on('click', function (e) {
    e.preventDefault();

    // Get the column API object
    var column = receipts_table.column($(this).attr('data-column'));
    $(this).toggleClass('line-through')

    // Toggle the visibility
    column.visible(!column.visible());
});

receipts_table.columns().every( function(index) {
    $(`a[data-column=${index}]`).addClass(!receipts_table.column(index).visible() ? 'line-through' : '');
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

    #receipts_table_wrapper .dt-buttons {
        float: none;
        display: inline-block;
        margin-left: 1rem;
    }
    #receipts_table_length {
        float: left;
    }
    #receipts_table_length label {
        margin-top: 0.5rem;
    }
</style>
@endpush