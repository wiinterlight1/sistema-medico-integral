<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/home.css', 'resources/css/navbar.css', 'resources/css/medicos.css'])
    <title>Médicos | Sistema Médico Integral</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, input, button, select, textarea, table {
        font-family: 'Poppins', sans-serif !important;
    }
</style>
</head>

<body>
    <div class="contenedor">
        <x-navbar />
        <main class="contenido">
            <div class="dashboard">

                @error('medico')
                    <div class="mensaje-error">
                        {{ $message }}
                    </div>
                @enderror

                <header class="dashboard-header">
                    <div>
                        <span class="etiqueta">SISTEMAS CLINICO / MÉDICOS</span>
                        <h1>Gestión de Médicos</h1>
                        <p>Administra y visualiza el directorio de médicos registrados en la clínica.</p>
                    </div>
                    <div class="header-icono">+</div>
                </header>

                <div class="tarjeta-principal">
                    <div class="seccion-titulo-accion">
                        <h3 class="subtitulo">Listado de Médicos</h3>
                        <x-medicos.modal-agregar :especialidades="$especialidades" />
                    </div>

                    @if (isset($medicos) && $medicos->isEmpty())
                        <div class="alerta-info">No hay médicos registrados en el sistema actualmente.</div>
                    @else
                        <div class="tabla-contenedor">
                            <table class="tabla-custom">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Especialidad</th>
                                        <th>Teléfono</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medicos as $medico)
                                        <tr>
                                            <td>{{ $medico->id }}</td>
                                            <td class="fw-bold">{{ $medico->nombre }}</td>
                                            <td>{{ $medico->apellido }}</td>
                                            <td>

                                                {{ $medico->especialidad->nombre ?? 'General' }}

                                            </td>
                                            <td>{{ $medico->telefono ?? 'N/A' }}</td>
                                            <td>
                                                @if ($medico->activo)
                                                    <span
                                                        style="color: #047857; font-weight: 600; background: #d1fae5; padding: 4px 8px; border-radius: 6px; font-size: 12px;">Activo</span>
                                                @else
                                                    <span
                                                        style="color: #b91c1c; font-weight: 600; background: #fee2e2; padding: 4px 8px; border-radius: 6px; font-size: 12px;">Inactivo</span>
                                                @endif
                                            <td>
                                                <div class="acciones-tabla">
                                                    <x-medicos.modal-actualizar :medico="$medico" :especialidades="$especialidades" />
                                                    <x-medicos.modal-eliminar :medico="$medico" />
                                                </div>
                                            </td>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

            </div>
        </main>
    </div>
</body>

</html>
