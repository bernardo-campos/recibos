@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Backups')

@section('content_header')
    <div class="d-flex justify-content-between">
        <div>
            <h1 class="m-0 text-dark">Backups en disco local</h1>
            <small></small>
        </div>
        <div id="btn-container">
        </div>
    </div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">
                <table id="backups" class="table table-sm table-hover w-100">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tamaño</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $spfileinfo)
                            <tr>
                                <td>{{ basename($spfileinfo->getRealPath()) }}</td>
                                @if (($sizeInKb = $spfileinfo->getSize() / 1024) < 1024)
                                    <td data-sort="{{ $sizeInKb }}">{{ dec($sizeInKb) }} KB</td>
                                @else
                                    <td data-sort="{{ $sizeInKb }}">{{ dec($sizeInKb / 1024) }} MB</td>
                                @endif
                                <td>{{ date('Y-m-d H:i:s', $spfileinfo->getCTime()) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
@stop

@push('js')
<script>
    $('#backups').DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        order: [[0, 'desc']],
    })
</script>
@endpush
