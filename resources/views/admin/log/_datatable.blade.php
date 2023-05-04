<table class="table table-sm" id="activitylog">
<thead>
    <tr>
        <th>#</th>
        <th>subject_type</th>
        <th>event</th>
        <th>subject_id</th>
        <th>causer_type</th>
        <th>causer_id</th>
        <th>properties</th>
        <th>created_at</th>
        <th>updated_at</th>
    </tr>
</thead>
<tbody></tbody>
</table>

@push('js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#activitylog').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
            },
            stateSave: true,
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.log.index') }}',
            search: { return: true },
            columns: [
                { data: 'id' },
                { data: 'subject_type' },
                { data: 'event' },
                { data: 'subject_id' },
                { data: 'causer_type' },
                { data: 'causer_id' },
                {
                    data: 'properties',
                    defaultContent: '',
                    orderable: false,
                    render: function ( data, type, row, meta ) {
                        // console.log({ data, type, row, meta });
                        if (type === 'display') {
                            if (data == '[]') {
                                return '';
                            }
                            return '<button class="btn btn-info btn-sm">Mostrar</button>';
                        }
                    },
                    createdCell:  function (td, cellData, rowData, row, col) {
                        $(td).attr('data-properties', rowData.properties); 
                    }
                },
                { data: 'created_at' },
                { data: 'updated_at' },
            ]
        });
    });

    $(document).on('click', 'button.btn.btn-info', function () {
        var data = $(this).parents('td').attr('data-properties').replace(/&quot;/g, '"');
        alert(data)
    });
</script>
@endpush

@push('css')
<style type="text/css">
    #activitylog {
        width: 100%!important;
    }
</style>
@endpush