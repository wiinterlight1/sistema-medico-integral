
<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\ConsultorioController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('home', [
        'totalPacientes' => \App\Models\Paciente::count(),
        'totalMedicos'   => \App\Models\Medico::count(),
        'totalCitas'     => \App\Models\Cita::count(),
    ]);
});

Route::get('/home', function () {
    return view('home', [
        'totalPacientes' => \App\Models\Paciente::count(),
        'totalMedicos' => \App\Models\Medico::count(),
        'totalCitas' => \App\Models\Cita::count(),
    ]);
});

// Pacientes
Route::get('/pacientes', [PacienteController::class, 'Getpacientes'])
    ->name('paciente.get');

Route::post('/pacientes/create', [PacienteController::class, 'createPaciente'])
    ->name('paciente.create');

Route::put('/pacientes/{paciente}', [PacienteController::class, 'updatePaciente'])
    ->name('paciente.update');

Route::delete('/pacientes/{paciente}', [PacienteController::class, 'deletepaciente'])
    ->name('paciente.delete');

// Especialidades
Route::get('/especialidades', [EspecialidadController::class, 'getEspecialidades'])
    ->name('especialidad.get');

Route::post('/especialidades/create', [EspecialidadController::class, 'createEspecialidad'])
    ->name('especialidad.create');

Route::put('/especialidades/{especialidad}', [EspecialidadController::class, 'updateEspecialidad'])
    ->name('especialidad.update');

Route::delete('/especialidades/{especialidad}', [EspecialidadController::class, 'deleteEspecialidad'])
    ->name('especialidad.delete');

// Médicos
Route::get('/medicos', [MedicoController::class, 'GetMedicos'])
    ->name('medicos.index');

Route::post('/medicos/create', [MedicoController::class, 'CreateMedicos'])
    ->name('medicos.create');

Route::put('/medicos/update/{id}', [MedicoController::class, 'UpdateMedico'])
    ->name('medicos.update');

Route::delete('/medicos/update/{id}', [MedicoController::class, 'DeleteMedico'])
    ->name('medicos.delete');

// Consultorios
Route::get('/consultorios', [ConsultorioController::class, 'GetConsultorio'])
    ->name('consultorios.index');

Route::post('/consultorios/create', [ConsultorioController::class, 'CreateConsultorio'])
    ->name('consultorio.create');

Route::put('/consultorios/update/{id}', [ConsultorioController::class, 'UpdateConsultorio'])
    ->name('consultorios.update');

Route::delete('/consultorios/delete/{id}', [ConsultorioController::class, 'DeleteConsultorio'])
    ->name('consultorios.delete');

// Citas
Route::get('/citas', [CitaController::class, 'getCitas'])
    ->name('citas.index');

Route::post('/citas/create', [CitaController::class, 'createCita'])
    ->name('citas.create');

Route::put('/citas/update/{cita}', [CitaController::class, 'updateCita'])
    ->name('citas.update');

Route::delete('/citas/delete/{cita}', [CitaController::class, 'deleteCita'])
    ->name('citas.delete');

// Completar cita
Route::patch('/citas/{cita}/completar', [CitaController::class, 'completarCita'])
    ->name('citas.completar');

// Historial
Route::get('/citas/historial', [CitaController::class, 'historial'])
    ->name('citas.historial');
