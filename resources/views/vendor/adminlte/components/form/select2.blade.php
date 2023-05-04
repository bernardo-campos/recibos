@extends('adminlte::components.form.input-group-component')

@section('input_group_item')

    {{-- Select --}}
    <select id="{{ $id }}" name="{{ $name }}"
        {{ $attributes->merge(['class' => $makeItemClass()]) }}>
        {{ $slot }}
    </select>

@overwrite

{{-- Add plugin initialization and configuration code --}}

@push('js')
<script>

    $(() => {
        $('#{{ $id }}').select2( @json($config) );

        // Add support to auto select old submitted values in case of
        // validation errors.

        @if($errors->any() && $enableOldSupport)

            let oldOptions = @json(collect($getOldValue($errorKey)));

            $('#{{ $id }} option').each(function()
            {
                let value = $(this).val() || $(this).text();
                $(this).prop('selected', oldOptions.includes(value));
            });

            $('#{{ $id }}').trigger('change');

        @endif
    })

</script>
@once
<script type="text/javascript">
    {{-- https://forums.select2.org/t/search-being-unfocused/1203/10 --}}
    // hack to fix jquery 3.6 focus security patch that bugs auto search in select-2
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });
</script>
@endonce
@endpush

{{-- Setup the height and font size of the plugin when using sm/lg sizes --}}
{{-- NOTE: this may change with newer plugin versions --}}

@once
@push('css')
<style type="text/css">

    {{-- SM size setup --}}
    .input-group-sm .select2-selection--single {
        height: calc(1.8125rem + 2px) !important
    }
    .input-group-sm .select2-selection--single .select2-selection__rendered,
    .input-group-sm .select2-selection--single .select2-selection__placeholder {
        font-size: .875rem !important;
        line-height: 2.125;
    }
    .input-group-sm .select2-selection--multiple {
        min-height: calc(1.8125rem + 2px) !important
    }
    .input-group-sm .select2-selection--multiple .select2-selection__rendered {
        font-size: .875rem !important;
        line-height: normal;
    }

    {{-- LG size setup --}}
    .input-group-lg .select2-selection--single {
        height: calc(2.875rem + 2px) !important;
    }
    .input-group-lg .select2-selection--single .select2-selection__rendered,
    .input-group-lg .select2-selection--single .select2-selection__placeholder {
        font-size: 1.25rem !important;
        line-height: 2.25;
    }
    .input-group-lg .select2-selection--multiple {
        min-height: calc(2.875rem + 2px) !important
    }
    .input-group-lg .select2-selection--multiple .select2-selection__rendered {
        font-size: 1.25rem !important;
        line-height: 1.7;
    }

</style>
@endpush
@endonce
