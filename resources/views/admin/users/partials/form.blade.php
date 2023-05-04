@section('plugins.inputmask', true)
@section('plugins.iCheck', true)

 <form class="form-horizontal" action="{{ $action }}" method="POST">
    @csrf
    @isset ($put)
        @method('PUT')
    @endisset
    <div class="card">
        <div class="card-body">

            <div class="row">
                <x-adminlte-input
                    value="{{ old('name', $user->name) }}"
                    id="name"
                    name="name"
                    type="text"
                    label="Nombre"
                    fgroup-class="col-12"
                    required
                />

                <x-adminlte-input
                    value="{{ old('email', $user->email) }}"
                    id="email"
                    name="email"
                    type="email"
                    label="Correo electrónico"
                    fgroup-class="col-12"
                    required
                />

                <x-adminlte-input
                    value="{{ old('dni', $user->dni ) }}"
                    id="dni"
                    name="dni"
                    type="tel"
                    label="DNI"
                    fgroup-class="col-12"
                />
            </div>

            <div class="row">
                <div class="icheck-primary">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="set_default_password"
                        id="set_default_password">
                    <label class="form-check-label" for="set_default_password">Establecer Password DNI</label>
                </div>
            </div>

            <hr>

            <div class="row">
                
                <div class="form-group col-12 col-md-6">
                    <label>Roles</label>
                    <div class="ml-2">
                        @foreach ($roles as $rol)
                            <div class="icheck-primary">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="roles[]"
                                    value="{{ $rol->id }}"
                                    id="rol_{{ $rol->id }}"
                                    @checked(collect(old('roles') ?? $user->roles->pluck('id')->toArray())->contains($rol->id))
                                    >
                                <label class="form-check-label" for="rol_{{ $rol->id }}">{{ $rol->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group col-12 col-md-6">
                    @include('admin.users.partials._permissions')
                </div>

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
