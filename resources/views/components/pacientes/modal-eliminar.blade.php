
@props(['paciente'])

<!-- MODAL ELIMINAR PACIENTE -->

<dialog
    id="eliminar-{{ $paciente->id }}"
    class="modal-paciente"
>

    <div class="modal-encabezado">

        <h2>Eliminar paciente</h2>

        <button
            type="button"
            class="btn-cerrar"
            commandfor="eliminar-{{ $paciente->id }}"
            command="close"
        >
            ✕
        </button>

    </div>

    <!-- MENSAJE DE CONFIRMACIÓN -->
    <div class="modal-mensaje">

        <h3>¿Deseas eliminar este paciente?</h3>

        <p>
            {{ $paciente->nombre }}
            {{ $paciente->apellido }}
        </p>

        <p>Esta acción no se puede deshacer.</p>

    </div>

    <!-- FORMULARIO ELIMINAR -->
    <form
        action="{{ route('paciente.delete', $paciente->id) }}"
        method="POST"
    >

        @csrf
        @method('DELETE')

        <div class="modal-acciones">

            <button
                type="button"
                class="btn-cancelar"
                commandfor="eliminar-{{ $paciente->id }}"
                command="close"
            >
                Cancelar
            </button>

            <button
                type="submit"
                class="btn-eliminar"
            >
                Sí, eliminar
            </button>

        </div>

    </form>

</dialog>
