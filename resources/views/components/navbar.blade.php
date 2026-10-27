<nav class="navbar">

<div class="logo px-4 py-3 bg-gray-900 border-b border-gray-800">
    <div class="flex items-center space-x-2">
        <div class="w-3 h-3 bg-indigo-500 rounded-full animate-pulse"></div>
        <p class="font-bold text-white tracking-wide">Área Clínica</p>
    </div>
    <span class="text-xs text-indigo-400 font-medium">Panel de Control </span>
</div>
<hr class="border-gray-800 my-2">

    <ul class="menu">
        <li>
            <a href="/home" class="{{ request()->is('home') ? 'activo' : '' }}">
                Inicio
            </a>
        </li>

        <li>
            <a href="/pacientes" class="{{ request()->is('pacientes') ? 'activo' : '' }}">
                Pacientes
            </a>
        </li>

        <li>
            <a href="/especialidades" class="{{ request()->is('especialidades') ? 'activo' : '' }}">
                Especialidades
            </a>
        </li>

        <li>
            <a href="/medicos" class="{{ request()->is('medicos') ? 'activo' : '' }}">
                Medicos
            </a>
        </li>

        <li>
            <a href="/citas" class="{{ request()->is('citas') ? 'activo' : '' }}">
                Citas
            </a>
        </li>

        <li>
            <a href="/consultorios" class="{{ request()->is('consultorios') ? 'activo' : '' }}">
                Consultorios
            </a>
        </li>
        <li>
            <a href="/citas/historial" class="{{ request()->is('historial') ? 'activo' : '' }}">
                Historial
            </a>
        </li>
    </ul>

    <hr>

    <small>
        Sistema Médico Integral
    </small>

</nav>