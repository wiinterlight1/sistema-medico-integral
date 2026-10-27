
@props(['cita', 'pacientes', 'medicos', 'consultorios'])

@php
    $modalId = 'editar-' . $cita->id;
    $tieneErrores = old('_modal') === $modalId && $errors->any();
@endphp

<!-- MODAL ACTUALIZAR CITA -->

<dialog
    id="{{ $modalId }}"
    class="modal-cita"
    @if($tieneErrores) open @endif
>

    <div class="modal-encabezado">

        <h2>Actualizar cita médica</h2>

        <button
            type="button"
            commandfor="{{ $modalId }}"
            command="close"
        >
            ✕
        </button>

    </div>

    <form
        action="{{ route('citas.update', $cita->id) }}"
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

        <!-- PACIENTE -->
        <div class="grupo-campo">

            <label>Paciente</label>

            <select name="paciente_id">

                <option value="">Seleccionar paciente</option>

                @foreach($pacientes as $paciente)

                    <option
                        value="{{ $paciente->id }}"
                        @selected(
                            (string) ($tieneErrores ? old('paciente_id') : $cita->paciente_id)
                            === (string) $paciente->id
                        )
                    >
                        {{ $paciente->nombre }}
                        {{ $paciente->apellido }}
                    </option>

                @endforeach

            </select>

            @if($tieneErrores)
                @error('paciente_id')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- MÉDICO -->
        <div class="grupo-campo">

            <label>Médico</label>

            <select name="medico_id">

                <option value="">Seleccionar médico</option>

                @foreach($medicos as $medico)

                    <option
                        value="{{ $medico->id }}"
                        @selected(
                            (string) ($tieneErrores ? old('medico_id') : $cita->medico_id)
                            === (string) $medico->id
                        )
                    >
                        {{ $medico->nombre }}
                        {{ $medico->apellido }}
                    </option>

                @endforeach

            </select>

            @if($tieneErrores)
                @error('medico_id')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- CONSULTORIO -->
        <div class="grupo-campo">

            <label>Consultorio</label>

            <select name="consultorio_id">

                <option value="">Seleccionar consultorio</option>

                @foreach($consultorios as $consultorio)

                    <option
                        value="{{ $consultorio->id }}"
                        @selected(
                            (string) ($tieneErrores ? old('consultorio_id') : $cita->consultorio_id)
                            === (string) $consultorio->id
                        )
                    >
                        {{ $consultorio->numero }}
                    </option>

                @endforeach

            </select>

            @if($tieneErrores)
                @error('consultorio_id')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- FECHA -->
        <div class="grupo-campo">

            <label>Fecha de la cita</label>

            <input
                type="date"
                name="fecha"
                min="{{ now('America/Monterrey')->format('Y-m-d') }}"
                value="{{ $tieneErrores ? old('fecha') : substr((string) $cita->fecha, 0, 10) }}"
            >

            @if($tieneErrores)
                @error('fecha')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- HORARIO -->
        <div class="aviso-horario">
            <strong>Horario de atención</strong>
            <p>De 8:00 a. m. a 6:00 p. m.</p>
        </div>

        <!-- HORA INICIO -->
        <div class="grupo-campo">

            <label>Hora de inicio</label>

            <input
                type="time"
                name="hora_inicio"
                min="08:00"
                max="18:00"
                value="{{ $tieneErrores ? old('hora_inicio') : substr((string) $cita->hora_inicio, 0, 5) }}"
            >

            @if($tieneErrores)
                @error('hora_inicio')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- HORA FINAL -->
        <div class="grupo-campo">

            <label>Hora de finalización</label>

            <input
                type="time"
                name="hora_fin"
                min="08:00"
                max="18:00"
                value="{{ $tieneErrores ? old('hora_fin') : substr((string) $cita->hora_fin, 0, 5) }}"
            >

            @if($tieneErrores)
                @error('hora_fin')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- ERRORES GENERALES -->
        @if($tieneErrores)
            @error('cita')
                <small class="error-campo">{{ $message }}</small>
            @enderror
        @endif

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

            <button type="submit" class="btn-guardar">
                Guardar cambios
            </button>

        </div>

    </form>

</dialog>
