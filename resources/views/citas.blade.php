
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Citas | Sistema Médico Integral</title>

    @vite([
        'resources/css/home.css',
        'resources/css/navbar.css',
        'resources/css/citas.css'
    ])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, input, button, select, textarea, table {
        font-family: 'Poppins', sans-serif !important;
    }
</style>
</head>

<body>

    <div class="contenedor">

        <!-- NAVBAR -->
        <x-navbar />

        <!-- CONTENIDO PRINCIPAL -->
        <main class="contenido">

   <!-- REESTRUCTURACIÓN DEL ENCABEZADO -->
<div class="citas-dashboard-moderno">
    <div class="header-content-flex">
        <div>
            <span class="badge-sistema-morado">SISTEMA MÉDICO INTEGRAL</span>
            <h1 class="titulo-principal-morado">Panel de Control de Citas</h1>
            <p class="subtitulo-gris">Gestión, control y seguimiento de consultas médicas en tiempo real.</p>
        </div>
        <div class="header-acciones">
            <!-- Botón de nueva cita con estructura renovada -->
            <button type="button" class="btn-nuevo-morado" commandfor="modalAgregar" command="show-modal">
                <i class="fas fa-plus-circle"></i> + Registrar Nueva Cita
            </button>
        </div>
    </div>
</div>
                    <button
                        type="button"
                        class="btn-principal"
                        commandfor="modalAgregar"
                        command="show-modal"
                    >
                        + Nueva cita
                    </button>

                </header>

                <!-- MENSAJES DE CONFIRMACIÓN -->
                @if(session('mensaje'))
                    <div class="mensaje-exito">
                        {{ session('mensaje') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mensaje-error">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- ERRORES GENERALES -->
                @error('cita')
                    <div class="mensaje-error">
                        {{ $message }}
                    </div>
                @enderror

                <!-- ESTADÍSTICAS -->
<section class="grid-estadisticas-morado">
    <div class="card-stat">
        <div class="stat-info">
            <h3>Total de Citas</h3>
            <p class="numero-stat">{{ $totalCitas }}</p>
        </div>
        <div class="stat-icon bg-purple-light">📋</div>
    </div>

    <div class="card-stat">
        <div class="stat-info">
            <h3>Pendientes</h3>
            <p class="numero-stat">{{ $citasPendientes }}</p>
        </div>
        <div class="stat-icon bg-yellow-light">⏳</div>
    </div>

    <div class="card-stat">
        <div class="stat-info">
            <h3>Completadas</h3>
            <p class="numero-stat">{{ $citasCompletadas }}</p>
        </div>
        <div class="stat-icon bg-green-light">✅</div>
    </div>

    <div class="card-stat">
        <div class="stat-info">
            <h3>Canceladas</h3>
            <p class="numero-stat">{{ $citasCanceladas }}</p>
        </div>
        <div class="stat-icon bg-red-light">❌</div>
    </div>
</section>

                <!-- AGENDA -->
                <section class="citas-panel">

                    <div class="panel-encabezado">

                        <div>
                            <h2>Agenda de citas</h2>
                            <p>
                                Consulta los horarios y las citas registradas.
                            </p>
                        </div>

                        <!-- BUSCADOR SIN JAVASCRIPT -->
                        <form action="{{ url('/citas') }}" method="GET">

                            <input
                                type="search"
                                id="buscarCita"
                                name="buscar"
                                placeholder="Buscar cita..."
                                value="{{ request('buscar') }}"
                            >

                            <button type="submit" class="btn-buscar">
                                Buscar
                            </button>

                        </form>

                    </div>

                    <!-- TABLA DE CITAS -->
                    <div class="tabla-contenedor">

                        <table class="tabla-citas">

                            <thead>
                                <tr>
                                    <th>Paciente</th>
                                    <th>Médico</th>
                                    <th>Consultorio</th>
                                    <th>Fecha</th>
                                    <th>Horario</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody id="listaCitas">

                                @forelse($citas as $cita)

                                    <tr class="fila-cita">

                                        <td>
                                            {{ $cita->paciente?->nombre ?? 'Sin paciente' }}
                                            {{ $cita->paciente?->apellido ?? '' }}
                                        </td>

                                        <td>
                                            {{ $cita->medico?->nombre ?? 'Sin médico' }}
                                            {{ $cita->medico?->apellido ?? '' }}
                                        </td>

                                        <td>
                                            Consultorio #{{ $cita->consultorio_id }}
                                        </td>

                                        <td>
                                            {{ $cita->fecha }}
                                        </td>

                                        <td>
                                            {{ substr((string) $cita->hora_inicio, 0, 5) }}
                                            -
                                            {{ substr((string) $cita->hora_fin, 0, 5) }}
                                        </td>

                                        <td>
                                            <span class="estado-cita estado-{{ $cita->estado }}">
                                                {{ ucfirst($cita->estado) }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="acciones">

                                                @if(in_array($cita->estado, ['pendiente', 'confirmada']))

                                                    <!-- EDITAR -->
                                                    <button
                                                        type="button"
                                                        class="btn-editar"
                                                        commandfor="editar-{{ $cita->id }}"
                                                        command="show-modal"
                                                    >
                                                        Editar
                                                    </button>

                                                    <!-- CANCELAR -->
                                                    <button
                                                        type="button"
                                                        class="btn-eliminar"
                                                        commandfor="eliminar-{{ $cita->id }}"
                                                        command="show-modal"
                                                    >
                                                        Cancelar
                                                    </button>

                                                    <!-- COMPLETAR -->
                                                    <button
                                                        type="button"
                                                        class="btn-completar"
                                                        commandfor="completar-{{ $cita->id }}"
                                                        command="show-modal"
                                                    >
                                                        Completar
                                                    </button>

                                                @else

                                                    <span class="texto-cancelada">
                                                        Sin acciones
                                                    </span>

                                                @endif

                                            </div>
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="7" class="tabla-vacia">
                                            @if(request('buscar'))
                                                No se encontraron citas.
                                            @else
                                                No hay citas registradas.
                                            @endif
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </section>

            </div>

        </main>

    </div>

    <!-- MODAL AGREGAR -->
    <x-citas.modal-agregar
        :pacientes="$pacientes"
        :medicos="$medicos"
        :consultorios="$consultorios"
    />

    <!-- MODALES ACTUALIZAR, CANCELAR Y COMPLETAR -->
    @foreach($citas as $cita)

        @if(in_array($cita->estado, ['pendiente', 'confirmada']))

            <x-citas.modal-actualizar
                :cita="$cita"
                :pacientes="$pacientes"
                :medicos="$medicos"
                :consultorios="$consultorios"
            />

            <x-citas.modal-eliminar :cita="$cita" />

            <!-- CONFIRMACIÓN PARA COMPLETAR CITA -->
            <dialog
                id="completar-{{ $cita->id }}"
                class="modal-cita"
            >

                <div class="modal-encabezado">

                    <h2>Completar cita</h2>

                    <button
                        type="button"
                        commandfor="completar-{{ $cita->id }}"
                        command="close"
                    >
                        ✕
                    </button>

                </div>

                <div class="modal-mensaje">

                    <h3>¿Marcar esta cita como completada?</h3>

                    <p>
                        {{ $cita->paciente?->nombre }}
                        {{ $cita->paciente?->apellido }}
                    </p>

                    <p>
                        Esta acción cambiará el estado de la cita
                        a completada.
                    </p>

                </div>

                <form
                    action="{{ route('citas.completar', $cita->id) }}"
                    method="POST"
                >

                    @csrf
                    @method('PATCH')

                    <div class="modal-acciones">

                        <button
                            type="button"
                            class="btn-cancelar"
                            commandfor="completar-{{ $cita->id }}"
                            command="close"
                        >
                            Volver
                        </button>

                        <button
                            type="submit"
                            class="btn-completar"
                        >
                            Confirmar
                        </button>

                    </div>

                </form>

            </dialog>

        @endif

    @endforeach

</body>
</html>
