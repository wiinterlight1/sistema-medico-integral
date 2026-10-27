<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite([
        'resources/css/home.css', 
        'resources/css/navbar.css', 
        'resources/css/historial.css'
    ])
    <title>Historial | Sistema Médico Integral</title>
</head>
<body>
    <div class="contenedor">
        <x-navbar />
        <main class="contenido">
            <div class="dashboard">
                <header class="dashboard-header">
                    <div>
                        <span class="etiqueta">SISTEMA MÉDICO INTEGRAL / HISTORIAL</span>
                        <h1>Historial y reportes</h1>
                        <p>Consulta aquí los historiales de pacientes, médicos y un resumen general.</p>
                    </div>
                    <div class="header-icono">+</div>
                </header>

                <div class="mis-pestanas">
                    <a href="{{ route('citas.historial', ['tab' => 'paciente']) }}" 
                       class="btn-pestana {{ (!request('medico_id') && request('tab') != 'medico' && request('tab') != 'stats') ? 'active' : '' }}">
                        Historial por Paciente
                    </a>
                    <a href="{{ route('citas.historial', ['tab' => 'medico', 'medico_id' => request('medico_id')]) }}" 
                       class="btn-pestana {{ (request('medico_id') || request('tab') == 'medico') ? 'active' : '' }}">
                        Citas por Médico
                    </a>
                    <a href="{{ route('citas.historial', ['tab' => 'stats']) }}" 
                       class="btn-pestana {{ request('tab') == 'stats' ? 'active' : '' }}">
                        Estadísticas Generales
                    </a>
                </div>

                <div class="tarjeta-principal">
                    <div class="panel-pestana {{ (!request('medico_id') && request('tab') != 'medico' && request('tab') != 'stats') ? 'active' : '' }}">
                        <form action="{{ route('citas.historial') }}" method="GET" class="formulario-filtro">
                            <input type="hidden" name="tab" value="paciente">
                            <div class="grupo-input">
                                <label for="paciente_id">Seleccionar Paciente:</label>
                                <select name="paciente_id" id="paciente_id" class="input-personalizado" onchange="this.form.submit()">
                                    <option value="">-- Selecciona un paciente --</option>
                                    @foreach($pacientes as $paciente)
                                        <option value="{{ $paciente->id }}" {{ request('paciente_id') == $paciente->id ? 'selected' : '' }}>
                                            {{ $paciente->nombre }} {{ $paciente->apellido }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        @if($pacienteSeleccionado)
                            <h3 class="subtitulo">Citas de: {{ $pacienteSeleccionado->nombre }} {{ $pacienteSeleccionado->apellido }}</h3>
                            @if($citasPaciente->isEmpty())
                                <div class="alerta-info">Este paciente no tiene citas registradas.</div>
                            @else
                                <div class="tabla-contenedor">
                                    <table class="tabla-custom">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                                <th>Médico</th>
                                                <th>Consultorio</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($citasPaciente as $cita)
                                                <tr>
                                                    <td>{{ $cita->fecha }}</td>
                                                    <td>{{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</td>
                                                    <td>{{ $cita->medico->nombre }} {{ $cita->medico->apellido }}</td>
                                                    <td>{{ $cita->consultorio->nombre ?? 'N/A' }}</td>
                                                    <td><span class="estado-badge estado-{{ $cita->estado }}">{{ ucfirst($cita->estado) }}</span></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endif
                    </div>

                    <div class="panel-pestana {{ (request('medico_id') || request('tab') == 'medico') ? 'active' : '' }}">
                        <form action="{{ route('citas.historial') }}" method="GET" class="formulario-filtro">
                            <input type="hidden" name="tab" value="medico">
                            <div class="grupo-input">
                                <label for="medico_id">Seleccionar Médico:</label>
                                <select name="medico_id" id="medico_id" class="input-personalizado" onchange="this.form.submit()">
                                    <option value="">-- Selecciona un médico --</option>
                                    @foreach($medicos as $medico)
                                        <option value="{{ $medico->id }}" {{ request('medico_id') == $medico->id ? 'selected' : '' }}>
                                            Dr. {{ $medico->nombre }} {{ $medico->apellido }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        @if($medicoSeleccionado)
                            <h3 class="subtitulo">Agenda del Dr. {{ $medicoSeleccionado->nombre }} {{ $medicoSeleccionado->apellido }}</h3>
                            @if($citasMedico->isEmpty())
                                <div class="alerta-info">Este médico no tiene citas programadas.</div>
                            @else
                                <div class="tabla-contenedor">
                                    <table class="tabla-custom">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Horario</th>
                                                <th>Paciente</th>
                                                <th>Consultorio</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($citasMedico as $cita)
                                                <tr>
                                                    <td>{{ $cita->fecha }}</td>
                                                    <td>{{ $cita->hora_inicio }} - {{ $cita->hora_fin }}</td>
                                                    <td>{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</td>
                                                    <td>{{ $cita->consultorio->nombre ?? 'N/A' }}</td>
                                                    <td><span class="estado-badge estado-{{ $cita->estado }}">{{ ucfirst($cita->estado) }}</span></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endif
                    </div>

                    <div class="panel-pestana {{ request('tab') == 'stats' ? 'active' : '' }}">
                        <h3 class="subtitulo">Resumen General de Consultas</h3>
                        <div class="contenedor-tarjetas">
                            <div class="tarjeta-stat">
                                <h5>Total Registradas</h5>
                                <h2>{{ $totalConsultas }}</h2>
                            </div>
                            <div class="tarjeta-stat">
                                <h5>Confirmadas</h5>
                                <h2 class="texto-verde">{{ $consultasConfirmadas }}</h2>
                            </div>
                            <div class="tarjeta-stat">
                                <h5>Pendientes</h5>
                                <h2 class="texto-amarillo">{{ $consultasPendientes }}</h2>
                            </div>
                            <div class="tarjeta-stat">
                                <h5>Canceladas</h5>
                                <h2 class="texto-rojo">{{ $consultasCanceladas }}</h2>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>
</body>
</html>