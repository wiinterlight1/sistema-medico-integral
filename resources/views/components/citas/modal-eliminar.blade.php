
@props(['cita'])

<!-- MODAL CANCELAR CITA -->

<dialog
    id="eliminar-{{ $cita->id }}"
    class="modal-cita"
>

    <div class="modal-encabezado">

        <h2>Cancelar cita médica</h2>

        <button
            type="button"
            commandfor="eliminar-{{ $cita->id }}"
            command="close"
        >
            ✕
        </button>

    </div>

    <!-- MENSAJE DE CONFIRMACIÓN -->
    <div class="modal-mensaje">

        <h3>¿Deseas cancelar esta cita?</h3>

        <p>
            <strong>Paciente:</strong>
            {{ $cita->paciente?->nombre ?? 'No disponible' }}
            {{ $cita->paciente?->apellido ?? '' }}
        </p>

        <p>
            <strong>Fecha:</strong>
            {{ $cita->fecha }}
        </p>

        <p>
            <strong>Horario:</strong>
            {{ substr((string) $cita->hora_inicio, 0, 5) }}
            -
            {{ substr((string) $cita->hora_fin, 0, 5) }}
        </p>

        <p class="advertencia">
            La cita quedará registrada como cancelada.
            No se eliminará del historial.
        </p>

    </div>

    <!-- FORMULARIO -->
    <form
        action="{{ route('citas.delete', $cita->id) }}"
        method="POST"
    >

        @csrf
        @method('DELETE')

        <div class="modal-acciones">

            <button
                type="button"
                class="btn-cancelar"
                commandfor="eliminar-{{ $cita->id }}"
                command="close"
            >
                Volver
            </button>

            <button
                type="submit"
                class="btn-eliminar"
                @if($cita->estado === 'cancelada') disabled @endif
            >
                Confirmar cancelación
            </button>

        </div>

    </form>

</dialog>
