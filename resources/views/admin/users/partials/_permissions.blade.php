<label>Permisos</label>
<div class="ml-2">
    @foreach ($permissions as $key1 => $value1)
        
        <div class="text-bold">{{ __($key1) }}</div>
        <div class="ml-2 pl-2">
            @foreach ($value1 as $key2 => $value2)

                @if (is_array($value2))
                    <div class="text-bold">{{ __($key2) }}</div>
                    <div class="ml-2 pl-2">
                        @foreach ($value2 as $key3 => $value3)
                            <div class="icheck-primary">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="permissions[]"
                                    value="{{ $value3 }}"
                                    id="permission_{{ $value3 }}"
                                    @checked(collect(old('permissions') ?? $user->permissions->pluck('id')->toArray())->contains($value3))
                                    >
                                <label class="form-check-label" for="permission_{{ $value3 }}">{{ $key3 }}</label>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="icheck-primary">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $value2 }}"
                                id="permission_{{ $value2 }}"
                                @checked(collect(old('permissions') ?? $user->permissions->pluck('id')->toArray())->contains($value2))
                                >
                            <label class="form-check-label" for="permission_{{ $value2 }}">{{ $key2 }}</label>
                        </div>
                @endif

            @endforeach
        </div>
        
    @endforeach
</div>

@push('css')
<style>
    .ml-2.pl-2 {
        border-left: 1px solid gray;
        gap: 10px;
        display: flex;
    }
    .ml-2.pl-2:has(.ml-2.pl-2) {
        display: block!important;
    }
</style>
@endpush