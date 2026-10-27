
@props(['pacientes', 'medicos', 'consultorios'])

@php
    $tieneErrores = old('_modal') === 'agregar' && $errors->any();
@endphp

<!-- MODAL AGREGAR CITA -->

<dialog
    id="modalAgregar"
    class="modal-cita"
    @if($tieneErrores) open @endif
>

    <div class="modal-encabezado">

        <h2>Agendar cita médica</h2>

        <button
            type="button"
            commandfor="modalAgregar"
            command="close"
        >
            ✕
        </button>

    </div>

    <form
        action="{{ route('citas.create') }}"
        method="POST"
        novalidate
    >

        @csrf

        <input
            type="hidden"
            name="_modal"
            value="agregar"
        >

        <!-- PACIENTE -->
        <div class="grupo-campo">

            <label for="paciente_id">Paciente</label>

            <select id="paciente_id" name="paciente_id">

                <option value="">Seleccionar paciente</option>

                @foreach($pacientes as $paciente)
                    <option
                        value="{{ $paciente->id }}"
                        @selected($tieneErrores && (string) old('paciente_id') === (string) $paciente->id)
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

            <label for="medico_id">Médico</label>

            <select id="medico_id" name="medico_id">

                <option value="">Seleccionar médico</option>

                @foreach($medicos as $medico)
                    <option
                        value="{{ $medico->id }}"
                        @selected($tieneErrores && (string) old('medico_id') === (string) $medico->id)
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

            <label for="consultorio_id">Consultorio</label>

            <select id="consultorio_id" name="consultorio_id">

                <option value="">Seleccionar consultorio</option>

                @foreach($consultorios as $consultorio)
                    <option
                        value="{{ $consultorio->id }}"
                        @selected($tieneErrores && (string) old('consultorio_id') === (string) $consultorio->id)
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

            <label for="fecha">Fecha de la cita</label>

            <input
                type="date"
                id="fecha"
                name="fecha"
                min="{{ now('America/Monterrey')->format('Y-m-d') }}"
                value="{{ $tieneErrores ? old('fecha') : '' }}"
            >

            @if($tieneErrores)
                @error('fecha')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- HORARIO DE ATENCIÓN -->
        <div class="aviso-horario">

            <strong>Horario de atención</strong>

            <p>De 8:00 a. m. a 7:00 p. m.</p>

        </div>

        <!-- HORA INICIO -->
        <div class="grupo-campo">

            <label for="hora_inicio">Hora de inicio</label>

            <input
                type="time"
                id="hora_inicio"
                name="hora_inicio"
                min="08:00"
                max="18:00"
                value="{{ $tieneErrores ? old('hora_inicio') : '' }}"
            >

            @if($tieneErrores)
                @error('hora_inicio')
                    <small class="error-campo">{{ $message }}</small>
                @enderror
            @endif

        </div>

        <!-- HORA FINAL -->
        <div class="grupo-campo">

            <label for="hora_fin">Hora de finalización</label>

            <input
                type="time"
                id="hora_fin"
                name="hora_fin"
                min="08:00"
                max="18:00"
                value="{{ $tieneErrores ? old('hora_fin') : '' }}"
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
                commandfor="modalAgregar"
                command="close"
            >
                Cancelar
            </button>

            <button type="submit" class="btn-guardar">
                Agendar cita
            </button>

        </div>

    </form>

</dialog>
