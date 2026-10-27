
@props(['paciente'])

@php
    $modalId = 'editar-' . $paciente->id;
    $tieneErrores = old('_form_context') === $modalId
        && $errors->any();
@endphp

<!-- MODAL ACTUALIZAR PACIENTE -->

<dialog
    id="{{ $modalId }}"
    class="modal-paciente"
    @if($tieneErrores)
        open
    @endif
>

    <div class="modal-encabezado">

        <h2>Actualizar paciente</h2>

        <button
            type="button"
            class="btn-cerrar"
            commandfor="{{ $modalId }}"
            command="close"
        >
            ✕
        </button>

    </div>

    <form
        action="{{ route('paciente.update', $paciente->id) }}"
        method="POST"
        class="form-paciente"
        novalidate
    >

        @csrf
        @method('PUT')

        <input
            type="hidden"
            name="_form_context"
            value="{{ $modalId }}"
        >

        <!-- NOMBRE -->
        <div class="grupo-campo">

            <label>Nombre</label>

            <input
                type="text"
                name="nombre"
                maxlength="255"
                value="{{ $tieneErrores ? old('nombre') : $paciente->nombre }}"
            >

            @if($tieneErrores)
                @error('nombre')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- APELLIDO -->
        <div class="grupo-campo">

            <label>Apellido</label>

            <input
                type="text"
                name="apellido"
                maxlength="255"
                value="{{ $tieneErrores ? old('apellido') : $paciente->apellido }}"
            >

            @if($tieneErrores)
                @error('apellido')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- TELÉFONO -->
        <div class="grupo-campo">

            <label>Teléfono</label>

            <input
                type="tel"
                name="telefono"
                maxlength="25"
                value="{{ $tieneErrores ? old('telefono') : $paciente->telefono }}"
            >

            @if($tieneErrores)
                @error('telefono')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- CORREO -->
        <div class="grupo-campo">

            <label>Correo electrónico (opcional)</label>

            <input
                type="email"
                name="correo"
                value="{{ $tieneErrores ? old('correo') : $paciente->correo }}"
            >

            @if($tieneErrores)
                @error('correo')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- FECHA DE NACIMIENTO -->
        <div class="grupo-campo">

            <label>Fecha de nacimiento</label>

            <input
                type="date"
                name="fecha_nacimiento"
                max="{{ date('Y-m-d') }}"
                value="{{ $tieneErrores ? old('fecha_nacimiento') : $paciente->fecha_nacimiento }}"
            >

            @if($tieneErrores)
                @error('fecha_nacimiento')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- ESTADO DEL PACIENTE -->
        <div class="grupo-campo">

            <label>Estado del paciente</label>

            <select name="activo">

                <option
                    value="1"
                    @selected((string) ($tieneErrores ? old('activo', $paciente->activo) : $paciente->activo) === '1')
                >
                    Activo
                </option>

                <option
                    value="0"
                    @selected((string) ($tieneErrores ? old('activo', $paciente->activo) : $paciente->activo) === '0')
                >
                    Inactivo
                </option>

            </select>

            @if($tieneErrores)
                @error('activo')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- BOTONES -->
        <div class="modal-acciones">

            <button
                type="button"
                class="btn-cancelar"
                commandfor="{{ $modalId }}"
                command="close"
            >
                Cancelar
            </button>

            <button
                type="submit"
                class="btn-guardar"
            >
                Guardar cambios
            </button>

        </div>

    </form>

</dialog>
