
<!-- MODAL AGREGAR ESPECIALIDAD -->

@php
    $tieneErrores = old('_modal') === 'agregar'
        && $errors->any();
@endphp

<dialog
    id="modalAgregar"
    class="modal-especialidad"
    @if($tieneErrores)
        open
    @endif
>

    <!-- ENCABEZADO -->
    <div class="modal-encabezado">

        <h2>Registrar especialidad</h2>

        <button
            type="button"
            commandfor="modalAgregar"
            command="close"
        >
            ✕
        </button>

    </div>

    <!-- FORMULARIO -->
    <form
        action="{{ route('especialidad.create') }}"
        method="POST"
        novalidate
    >

        @csrf

        <input
            type="hidden"
            name="_modal"
            value="agregar"
        >

        <!-- NOMBRE -->
        <div class="grupo-campo">

            <label for="nombre">
                Nombre de la especialidad
            </label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                maxlength="255"
                value="{{ $tieneErrores ? old('nombre') : '' }}"
            >

            @if($tieneErrores)
                @error('nombre')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- DESCRIPCIÓN -->
        <div class="grupo-campo">

            <label for="descripcion">
                Descripción (opcional)
            </label>

            <textarea
                id="descripcion"
                name="descripcion"
                rows="4"
            >{{ $tieneErrores ? old('descripcion') : '' }}</textarea>

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
                commandfor="modalAgregar"
                command="close"
            >
                Cancelar
            </button>

            <button
                type="submit"
                class="btn-guardar"
            >
                Guardar especialidad
            </button>

        </div>

    </form>

</dialog>
