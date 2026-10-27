
@props(['especialidad'])

@php
    $modalId = 'editar-' . $especialidad->id;
    $tieneErrores = old('_modal') === $modalId && $errors->any();
@endphp

<!-- MODAL ACTUALIZAR ESPECIALIDAD -->

<dialog
    id="{{ $modalId }}"
    class="modal-especialidad"
    @if($tieneErrores) open @endif
>

    <div class="modal-encabezado">

        <h2>Actualizar especialidad</h2>

        <button
            type="button"
            commandfor="{{ $modalId }}"
            command="close"
        >
            ✕
        </button>

    </div>

    <form
        action="{{ route('especialidad.update', $especialidad->id) }}"
        method="POST"
        novalidate
    >

        @csrf
        @method('PUT')

        <input
            type="hidden"
            name="_modal"
            value="{{ $modalId }}"
        >

        <!-- NOMBRE -->
        <div class="grupo-campo">

            <label>Nombre de la especialidad</label>

            <input
                type="text"
                name="nombre"
                maxlength="255"
                value="{{ $tieneErrores ? old('nombre') : $especialidad->nombre }}"
            >

            @if($tieneErrores)
                @error('nombre')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- DESCRIPCIÓN -->
        <div class="grupo-campo">

            <label>Descripción (opcional)</label>

            <textarea
                name="descripcion"
                rows="4"
            >{{ $tieneErrores ? old('descripcion') : $especialidad->descripcion }}</textarea>

            @if($tieneErrores)
                @error('descripcion')
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
