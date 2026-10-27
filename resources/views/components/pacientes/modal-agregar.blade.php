
<!-- MODAL AGREGAR PACIENTE -->

<dialog
    id="modalRegistro"
    class="modal-paciente"
    @if(old('_form_context') === 'modalRegistro' && $errors->any())
        open
    @endif
>

    <div class="modal-encabezado">

        <h2>Registrar paciente</h2>

        <button
            type="button"
            class="btn-cerrar"
            commandfor="modalRegistro"
            command="close"
        >
            ✕
        </button>

    </div>

    <form
        action="{{ route('paciente.create') }}"
        method="POST"
        class="form-paciente"
        novalidate
    >

        @csrf

        <input
            type="hidden"
            name="_form_context"
            value="modalRegistro"
        >

        <!-- NOMBRE -->
        <div class="grupo-campo">

            <label for="nombre">Nombre</label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('_form_context') === 'modalRegistro' ? old('nombre') : '' }}"
                maxlength="255"
            >

            @if(old('_form_context') === 'modalRegistro')
                @error('nombre')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- APELLIDO -->
        <div class="grupo-campo">

            <label for="apellido">Apellido</label>

            <input
                type="text"
                id="apellido"
                name="apellido"
                value="{{ old('_form_context') === 'modalRegistro' ? old('apellido') : '' }}"
                maxlength="255"
            >

            @if(old('_form_context') === 'modalRegistro')
                @error('apellido')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- TELÉFONO -->
        <div class="grupo-campo">

            <label for="telefono">Teléfono</label>

            <input
                type="tel"
                id="telefono"
                name="telefono"
                value="{{ old('_form_context') === 'modalRegistro' ? old('telefono') : '' }}"
                maxlength="25"
            >

            @if(old('_form_context') === 'modalRegistro')
                @error('telefono')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- CORREO -->
        <div class="grupo-campo">

            <label for="correo">Correo electrónico (opcional)</label>

            <input
                type="email"
                id="correo"
                name="correo"
                value="{{ old('_form_context') === 'modalRegistro' ? old('correo') : '' }}"
            >

            @if(old('_form_context') === 'modalRegistro')
                @error('correo')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- FECHA DE NACIMIENTO -->
        <div class="grupo-campo">

            <label for="fecha_nacimiento">
                Fecha de nacimiento
            </label>

            <input
                type="date"
                id="fecha_nacimiento"
                name="fecha_nacimiento"
                max="{{ date('Y-m-d') }}"
                value="{{ old('_form_context') === 'modalRegistro' ? old('fecha_nacimiento') : '' }}"
            >

            @if(old('_form_context') === 'modalRegistro')
                @error('fecha_nacimiento')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- BOTONES -->
        <div class="modal-acciones">

            <button
                type="button"
                class="btn-cancelar"
                commandfor="modalRegistro"
                command="close"
            >
                Cancelar
            </button>

            <button
                type="submit"
                class="btn-guardar"
            >
                Guardar paciente
            </button>

        </div>

    </form>

</dialog>
