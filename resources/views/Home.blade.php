<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/home.css', 'resources/css/navbar.css'])

    <title>Inicio | Sistema Médico Integral</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, input, button, select, textarea, table {
        font-family: 'Poppins', sans-serif !important;
    }
</style>
</head>

<body>

    <div class="contenedor">

        <!-- Navbar -->
        <x-navbar />

        <!-- Contenido principal -->
        <main class="contenido">

            <div class="dashboard">

                <!-- Encabezado -->
                <header class="dashboard-header">
                    <div>
                        <span class="etiqueta">
                            SISTEMAS CLINICO / PANEL GENERAL;
                        </span>

                        <h1>Panel de administración</h1>

                        <p>
                            Organiza y supervisa la actividad de tu clínica.
                        </p>
                    </div>

                    <div class="header-icono">✚</div>
                </header>

                <!-- Bienvenida -->
                <section class="bienvenida">

                    <div class="bienvenida-contenido">
                        <span>BIENVENIDO</span>

                        <h2>SISTEMA MÉDICO INTEGRAL</h2>

                        <p>
                            Administra y supervisa la actividad de tu clínica desde un solo lugar.
                        </p>
                    </div>

                    <div class="bienvenida-decoracion">✚</div>

                </section>

 <!-- Sección de Estadísticas con diseño renovado -->
<section class="estatisticas grid grid-cols-1 md:grid-cols-3 gap-4 my-6">
    
    <!-- Tarjeta de Pacientes -->
    <article class="estadistica-card bg-white p-5 rounded-xl shadow-sm border-l-4 border-indigo-500 flex justify-between items-center">
        <div>
            <span class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Registros</span>
            <h3 class="text-gray-700 font-medium mt-1">Pacientes Activos</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPacientes }}</p>
        </div>
        <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold">
            P
        </div>
    </article>

    <!-- Tarjeta de Médicos -->
    <article class="estadistica-card bg-white p-5 rounded-xl shadow-sm border-l-4 border-emerald-500 flex justify-between items-center">
        <div>
            <span class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Personal</span>
            <h3 class="text-gray-700 font-medium mt-1">Médicos en Planta</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalMedicos }}</p>
        </div>
        <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-600 font-bold">
            M
        </div>
    </article>

    <!-- Tarjeta de Citas -->
    <article class="estadistica-card bg-white p-5 rounded-xl shadow-sm border-l-4 border-amber-500 flex justify-between items-center">
        <div>
            <span class="text-gray-400 text-xs uppercase tracking-wider font-semibold">Agenda</span>
            <h3 class="text-gray-700 font-medium mt-1">Citas Programadas</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalCitas }}</p>
        </div>
        <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600 font-bold">
            C
        </div>
    </article>

</section>

                <!-- Agenda de citas -->
                <section class="panel agenda">

                    <div class="panel-encabezado">
                        <div>
                            <h2>Agenda de citas</h2>
                            <p>
                                Consulta y organiza las próximas consultas.
                            </p>
                        </div>

                        <a href="/citas" class="enlace-panel">
                            Ver todas →
                        </a>
                    </div>

                    <div class="agenda-vacia">

                        <div class="agenda-icono">▦</div>

                        <h3>Tu agenda médica</h3>

                        <p>
                            Consulta aquí las próximas citas de la clínica.
                        </p>

                        <a href="/citas" class="boton-agenda">
                            Gestionar citas
                        </a>

                    </div>

                </section>

                <!-- Accesos rápidos -->
                <section class="panel accesos">

                    <div class="panel-encabezado">
                        <div>
                            <h2>Accesos rápidos</h2>
                            <p>
                                Herramientas para tu trabajo diario.
                            </p>
                        </div>
                    </div>

                    <div class="accesos-grid">

                        <a href="/pacientes" class="acceso">
                            <span class="acceso-icono">♙</span>

                            <div>
                                <h3>Pacientes</h3>
                                <p>Consultar registros</p>
                            </div>

                            <span class="flecha">→</span>
                        </a>

                        <a href="/citas" class="acceso">
                            <span class="acceso-icono">▦</span>

                            <div>
                                <h3>Citas médicas</h3>
                                <p>Administrar agenda</p>
                            </div>

                            <span class="flecha">→</span>
                        </a>

                        <a href="/medicos" class="acceso">
                            <span class="acceso-icono">✚</span>

                            <div>
                                <h3>Médicos</h3>
                                <p>Personal médico</p>
                            </div>

                            <span class="flecha">→</span>
                        </a>

                        <a href="/consultorios" class="acceso">
                            <span class="acceso-icono">⌂</span>

                            <div>
                                <h3>Consultorios</h3>
                                <p>Administrar espacios</p>
                            </div>

                            <span class="flecha">→</span>
                        </a>

                    </div>

                </section>

                <!-- Pie de página -->
<footer class="dashboard-footer">
    SISTEMA MÉDICO INTEGRAL 
</footer>

            </div>

        </main>

    </div>

</body>

</html>
