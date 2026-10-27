
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Especialidades | Sistema Médico Integral</title>

    @vite([
        'resources/css/home.css',
        'resources/css/navbar.css',
        'resources/css/especialidad.css'
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

            <div class="especialidades-dashboard">

                <!-- ENCABEZADO -->
                <header class="especialidades-header">

                    <div>
                        <span class="etiqueta">
                            SISTEMAS CLINICO / ESPECIALIDADES
                        </span>

                        <h1>Gestión de especialidades</h1>

                        <p>
                            Administra las especialidades médicas
                            disponibles en la clínica.
                        </p>
                    </div>

                    <button
                        type="button"
                        class="btn-principal"
                        commandfor="modalAgregar"
                        command="show-modal"
                    >
                        + Nueva especialidad
                    </button>

                </header>

                <!-- MENSAJES DE CONFIRMACIÓN -->
                @if(session('success'))
                    <div class="mensaje-exito">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- ERRORES GENERALES -->
                @if(session('error'))
                    <div class="mensaje-error">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->has('especialidad'))
                    <div class="mensaje-error">
                        {{ $errors->first('especialidad') }}
                    </div>
                @endif

                <!-- ESTADÍSTICAS -->
                <section class="especialidades-estadisticas">

                    <div class="especialidades-resumen">

                        <h3>Especialidades registradas</h3>

                        <h2>{{ $especialidades->count() }}</h2>

                        <p>Total de especialidades en el sistema</p>

                    </div>

                </section>

                <!-- DIRECTORIO -->
                <section class="especialidades-panel">

                    <div class="panel-encabezado">

                        <div>
                            <h2>Directorio de especialidades</h2>

                            <p>
                                Consulta las especialidades registradas.
                            </p>
                        </div>

                        <!-- BUSCADOR SIN JAVASCRIPT -->
                        <form
                            action="{{ url('/especialidades') }}"
                            method="GET"
                        >

                            <input
                                type="search"
                                id="buscarEspecialidad"
                                name="buscar"
                                placeholder="Buscar especialidad..."
                                value="{{ request('buscar') }}"
                            >

                            <button type="submit">
                                Buscar
                            </button>

                        </form>

                    </div>

                    <!-- TABLA -->
                    <div class="tabla-contenedor">

                        <table class="tabla-especialidades">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Especialidad</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody id="listaEspecialidades">

                                @forelse($especialidades as $especialidad)

                                    <tr class="fila-especialidad">

                                        <td>
                                            {{ $especialidad->id }}
                                        </td>

                                        <td>
                                            {{ $especialidad->nombre }}
                                        </td>

                                        <td>
                                            {{ $especialidad->descripcion ?? 'Sin descripción' }}
                                        </td>

                                        <td>
                                            <div class="acciones">

                                                <!-- EDITAR -->
                                                <button
                                                    type="button"
                                                    class="btn-editar"
                                                    commandfor="editar-{{ $especialidad->id }}"
                                                    command="show-modal"
                                                >
                                                    Editar
                                                </button>

                                                <!-- ELIMINAR -->
                                                <button
                                                    type="button"
                                                    class="btn-eliminar"
                                                    commandfor="eliminar-{{ $especialidad->id }}"
                                                    command="show-modal"
                                                >
                                                    Eliminar
                                                </button>

                                            </div>
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="tabla-vacia">

                                            @if(request('buscar'))
                                                No se encontraron especialidades.
                                            @else
                                                No hay especialidades registradas.
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
    <x-especialidades.modal-agregar />

    <!-- MODALES ACTUALIZAR Y ELIMINAR -->
    @foreach($especialidades as $especialidad)

        <x-especialidades.modal-actualizar
            :especialidad="$especialidad"
        />

        <x-especialidades.modal-eliminar
            :especialidad="$especialidad"
        />

    @endforeach

</body>
</html>
