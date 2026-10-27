
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pacientes | Sistema Médico Integral</title>

    @vite([
        'resources/css/home.css',
        'resources/css/navbar.css',
        'resources/css/pacientes.css'
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

            <div class="pacientes-dashboard">

                <!-- ENCABEZADO -->
                <header class="pacientes-header">

                    <div>
                        <span class="etiqueta">
                            SISTEMAS CLINICO / PACIENTES
                        </span>

                        <h1>Gestión de pacientes</h1>

                        <p>
                            Consulta y administra los registros de la clínica.
                        </p>
                    </div>

                    <button
                        type="button"
                        class="btn-principal"
                        commandfor="modalRegistro"
                        command="show-modal"
                    >
                        + Nuevo paciente
                    </button>

                </header>

                <!-- MENSAJES DE CONFIRMACIÓN -->
                @if(session('success'))
                    <div class="mensaje-exito">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- ERRORES GENERALES -->
                @if($errors->has('paciente'))
                    <div class="mensaje-error">
                        {{ $errors->first('paciente') }}
                    </div>
                @endif

                <!-- ESTADÍSTICAS -->
                <section class="pacientes-estadisticas">

                    <div class="pacientes-resumen">

                        <h3>Pacientes registrados</h3>

                        <h2>{{ $pacientes->count() }}</h2>

                        <p>Total de pacientes en el sistema</p>

                    </div>

                </section>

                <!-- DIRECTORIO -->
                <section class="pacientes-panel">

                    <div class="panel-encabezado">

                        <div>
                            <h2>Directorio de pacientes</h2>

                            <p>
                                Información de los pacientes registrados.
                            </p>
                        </div>

                        <!-- BUSCADOR -->
                        <form action="{{ url('/pacientes') }}" method="GET">

                            <input
                                type="search"
                                name="buscar"
                                id="buscarPaciente"
                                placeholder="Buscar paciente..."
                                value="{{ request('buscar') }}"
                            >

                            <button type="submit">
                                Buscar
                            </button>

                        </form>

                    </div>

                    <!-- TABLA DE PACIENTES -->
                    <div class="tabla-contenedor">

                        <table class="tabla-pacientes">

                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody id="listaPacientes">

                                @forelse($pacientes as $paciente)

                                    <tr class="fila-paciente">

                                        <td>{{ $paciente->nombre }}</td>

                                        <td>{{ $paciente->apellido }}</td>

                                        <td>{{ $paciente->telefono }}</td>

                                        <td>
                                            {{ $paciente->correo ?? 'Sin correo' }}
                                        </td>

                                        <td>
                                            {{ $paciente->fecha_nacimiento }}
                                        </td>

                                        <!-- ESTADO DEL PACIENTE -->
                                        <td>

                                            @if($paciente->activo)

                                                <span class="estado-paciente estado-activo">
                                                    Activo
                                                </span>

                                            @else

                                                <span class="estado-paciente estado-inactivo">
                                                    Inactivo
                                                </span>

                                            @endif

                                        </td>

                                        <!-- ACCIONES -->
                                        <td>

                                            <div class="acciones">

                                                <!-- EDITAR -->
                                                <button
                                                    type="button"
                                                    class="btn-editar"
                                                    commandfor="editar-{{ $paciente->id }}"
                                                    command="show-modal"
                                                >
                                                    Editar
                                                </button>

                                                <!-- ELIMINAR -->
                                                <button
                                                    type="button"
                                                    class="btn-eliminar"
                                                    commandfor="eliminar-{{ $paciente->id }}"
                                                    command="show-modal"
                                                >
                                                    Eliminar
                                                </button>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="7" class="tabla-vacia">
                                            No hay pacientes registrados.
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
    <x-pacientes.modal-agregar />

    <!-- MODALES ACTUALIZAR Y ELIMINAR -->
    @foreach($pacientes as $paciente)

        <x-pacientes.modal-actualizar :paciente="$paciente" />

        <x-pacientes.modal-eliminar :paciente="$paciente" />

    @endforeach

</body>
</html>
