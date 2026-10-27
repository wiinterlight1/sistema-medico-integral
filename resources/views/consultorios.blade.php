<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/home.css', 'resources/css/navbar.css', 'resources/css/consultorios.css'])
    <title>Consultorios | Sistema Médico Integral</title>
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
                @error('consultorio')
            <div class="mensaje-error" style="color: #b91c1c; background: #fee2e2; padding: 10px 15px; border-radius: 6px; margin-bottom: 20px; font-weight: 500;">
                {{ $message }}
            </div>
        @enderror
                <header class="dashboard-header">
                    <div>
                        <span class="etiqueta">SISTEMAS CLINICO/ CONSULTORIOS</span>
                        <h1>Consultorios</h1>
                        <p>Administra y visualiza los espacios médicos disponibles en la clínica.</p>
                    </div>
                    <div class="header-icono">+</div>
                </header>

                <div class="tarjeta-principal">
                    <div class="seccion-titulo-accion">
                        <h3 class="subtitulo">Listado de Consultorios</h3>
                        <x-consultorios.modal-agregar />
                    </div>
                    @if (isset($consultorios) && $consultorios->isEmpty())
                        <div class="alerta-info">No hay consultorios registrados en el sistema actualmente.</div>
                    @else
                        <div class="tabla-contenedor">
                            <table class="tabla-custom">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Ubicación</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($consultorios as $consultorio)
                                        <tr>
                                            <td>{{ $consultorio->id }}</td>
                                            <td class="fw-bold">{{ $consultorio->numero }}</td>
                                            <td>{{ $consultorio->ubicacion ?? 'N/A' }}</td>
                                            ><td>
                                                @if ($consultorio->activo)
                                                    <span
                                                        style="color: #047857; font-weight: 600; background: #d1fae5; padding: 4px 8px; border-radius: 6px; font-size: 12px;">Activo</span>
                                                @else
                                                    <span
                                                        style="color: #b91c1c; font-weight: 600; background: #fee2e2; padding: 4px 8px; border-radius: 6px; font-size: 12px;">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="acciones-tabla">
                                                    <x-consultorios.modal-actualizar :consultorio="$consultorio" />
                                                    <x-consultorios.modal-eliminar :consultorio="$consultorio" />
                                                </div>
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
