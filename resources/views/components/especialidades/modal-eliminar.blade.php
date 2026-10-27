
@props(['especialidad'])

<!-- MODAL ELIMINAR ESPECIALIDAD -->

<dialog
    id="eliminar-{{ $especialidad->id }}"
    class="modal-especialidad"
>

    <div class="modal-encabezado">

        <h2>Eliminar especialidad</h2>

        <button
            type="button"
            commandfor="eliminar-{{ $especialidad->id }}"
            command="close"
        >
            ✕
        </button>

    </div>

    <!-- MENSAJE DE CONFIRMACIÓN -->
    <div class="modal-mensaje">

        <h3>¿Deseas eliminar esta especialidad?</h3>

        <p>
            <strong>{{ $especialidad->nombre }}</strong>
        </p>

        <p>Esta acción no se puede deshacer.</p>

        <p class="advertencia">
            No podrás eliminarla si tiene médicos registrados.
        </p>

    </div>

    <!-- FORMULARIO ELIMINAR -->
    <form
        action="{{ route('especialidad.delete', $especialidad->id) }}"
        method="POST"
    >

        @csrf
        @method('DELETE')

        <div class="modal-acciones">

            <button
                type="button"
                class="btn-cancelar"
                commandfor="eliminar-{{ $especialidad->id }}"
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
