<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Consultorio;
use App\Models\Medico;
use App\Models\Paciente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CitaController extends Controller
{
    public function getCitas(Request $request)
    {
        $buscar = trim((string) $request->input('buscar', ''));

        $citas = Cita::with(['paciente', 'medico', 'consultorio'])
            ->when($buscar !== '', function ($consulta) use ($buscar) {

                $consulta->where(function ($query) use ($buscar) {

                    $query->whereHas('paciente', function ($q) use ($buscar) {
                        $q->where('nombre', 'like', "%{$buscar}%")
                            ->orWhere('apellido', 'like', "%{$buscar}%");
                    })

                    ->orWhereHas('medico', function ($q) use ($buscar) {
                        $q->where('nombre', 'like', "%{$buscar}%")
                            ->orWhere('apellido', 'like', "%{$buscar}%");
                    })

                    ->orWhereHas('consultorio', function ($q) use ($buscar) {
                        $q->where('numero', 'like', "%{$buscar}%");
                    })

                    ->orWhere('fecha', 'like', "%{$buscar}%")
                    ->orWhere('estado', 'like', "%{$buscar}%");

                });

            })
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get();

        $totalCitas = Cita::count();

        $citasPendientes = Cita::where('estado', 'pendiente')->count();

        $citasCompletadas = Cita::where('estado', 'completada')->count();

        $citasCanceladas = Cita::where('estado', 'cancelada')->count();

         $pacientes = Paciente::where('activo', true)
        ->orderBy('nombre')
        ->get();

        $medicos = Medico::where('activo', true)
            ->orderBy('nombre')
            ->get();

        $consultorios = Consultorio::where('activo', true)
            ->get();

        return view('citas', compact(
            'citas',
            'pacientes',
            'medicos',
            'consultorios',
            'totalCitas',
            'citasPendientes',
            'citasCompletadas',
            'citasCanceladas'
        ));
    }

    
    private function validarDisponibilidad(array $datos, ?int $exceptoId = null)
    {
        $inicio = $datos['hora_inicio'];
        $fin = $datos['hora_fin'];

        if ($inicio >= $fin) {
            throw ValidationException::withMessages([
                'hora_fin' => 'La hora final debe ser mayor que la inicial.',
            ]);
        }

        if ($inicio < '08:00' || $fin > '18:00') {
            throw ValidationException::withMessages([
                'hora_inicio' => 'El horario permitido es de 08:00 a 18:00.',
            ]);
        }

        $paciente = Paciente::whereKey($datos['paciente_id'])
        ->lockForUpdate()
        ->firstOrFail();

        if (!$paciente->activo) {
            throw ValidationException::withMessages([
            'paciente_id' => 'El paciente no se encuentra activo.',
            ]);
        }

        $fechaHora = Carbon::parse(
            $datos['fecha'] . ' ' . $inicio,
            'America/Monterrey'
        );

        if ($fechaHora->lessThanOrEqualTo(Carbon::now('America/Monterrey'))) {
            throw ValidationException::withMessages([
                'fecha' => 'La cita debe programarse para una fecha y hora futuras.',
            ]);
        }

        $medico = Medico::whereKey($datos['medico_id'])
            ->lockForUpdate()
            ->firstOrFail();

        if (!$medico->activo) {
            throw ValidationException::withMessages([
                'medico_id' => 'El médico no se encuentra activo.',
            ]);
        }

        $consultorio = Consultorio::whereKey($datos['consultorio_id'])
            ->lockForUpdate()
            ->firstOrFail();

        if (!$consultorio->activo) {
            throw ValidationException::withMessages([
                'consultorio_id' => 'El consultorio no se encuentra activo.',
            ]);
        }

        $horarioMedico = Cita::where('medico_id', $datos['medico_id'])
            ->where('fecha', $datos['fecha'])
            ->whereNotIn('estado', ['cancelada', 'completada'])
            ->where('hora_inicio', '<', $fin)
            ->where('hora_fin', '>', $inicio)
            ->when($exceptoId, function ($query) use ($exceptoId) {
                $query->where('id', '!=', $exceptoId);
            })
            ->exists();

        if ($horarioMedico) {
            throw ValidationException::withMessages([
                'medico_id' => 'El médico ya tiene una cita en ese horario.',
            ]);
        }

        $horarioConsultorio = Cita::where('consultorio_id', $datos['consultorio_id'])
            ->where('fecha', $datos['fecha'])
            ->whereNotIn('estado', ['cancelada', 'completada'])
            ->where('hora_inicio', '<', $fin)
            ->where('hora_fin', '>', $inicio)
            ->when($exceptoId, function ($query) use ($exceptoId) {
                $query->where('id', '!=', $exceptoId);
            })
            ->exists();

        if ($horarioConsultorio) {
            throw ValidationException::withMessages([
                'consultorio_id' => 'El consultorio ya está ocupado en ese horario.',
            ]);
        }
    }

    public function createCita(Request $request)
    {
        $datos = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'consultorio_id' => 'required|exists:consultorios,id',
            'fecha' => 'required|date_format:Y-m-d',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
        ]);

        DB::transaction(function () use ($datos) {

            $this->validarDisponibilidad($datos);

            Cita::create($datos);

        }, 3);

        return redirect('/citas')
            ->with('mensaje', 'Cita registrada correctamente.');
    }

    public function updateCita(Request $request, Cita $cita)
    {
        $datos = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'consultorio_id' => 'required|exists:consultorios,id',
            'fecha' => 'required|date_format:Y-m-d',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
        ]);

        DB::transaction(function () use ($cita, $datos) {

            $citaActualizada = Cita::whereKey($cita->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (in_array($citaActualizada->estado, ['cancelada', 'completada'])) {
                throw ValidationException::withMessages([
                    'cita' => 'No se pueden modificar citas canceladas o completadas.',
                ]);
            }

            $this->validarDisponibilidad(
                $datos,
                $citaActualizada->id
            );

            $citaActualizada->update($datos);

        }, 3);

        return redirect('/citas')
            ->with('mensaje', 'Cita actualizada correctamente.');
    }

    public function completarCita(Cita $cita)
    {
        DB::transaction(function () use ($cita) {

            $citaActual = Cita::whereKey($cita->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (!in_array($citaActual->estado, ['pendiente', 'confirmada'])) {
                throw ValidationException::withMessages([
                    'cita' => 'Solo se pueden completar citas pendientes o confirmadas.',
                ]);
            }

            $citaActual->update([
                'estado' => 'completada',
            ]);

        });

        return redirect('/citas')
            ->with('mensaje', 'Cita completada correctamente.');
    }

    public function deleteCita(Cita $cita)
    {
        DB::transaction(function () use ($cita) {

            $citaActual = Cita::whereKey($cita->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (in_array($citaActual->estado, ['cancelada', 'completada'])) {
                throw ValidationException::withMessages([
                    'cita' => 'No se pueden cancelar citas canceladas o completadas.',
                ]);
            }

            $citaActual->update([
                'estado' => 'cancelada',
            ]);

        });

        return redirect('/citas')
            ->with('mensaje', 'Cita cancelada correctamente.');
    }

    public function Historial(Request $request)
    {
        $pacientes = Paciente::all();
        $medicos = Medico::all();

        $pacienteSeleccionado = null;
        $medicoSeleccionado = null;

        $citasPaciente = collect();
        $citasMedico = collect();

        if ($request->filled('paciente_id')) {

            $pacienteSeleccionado = Paciente::findOrFail(
                $request->paciente_id
            );

            $citasPaciente = $pacienteSeleccionado->citas()
                ->with(['medico', 'consultorio'])
                ->orderBy('fecha', 'desc')
                ->get();
        }

        if ($request->filled('medico_id')) {

            $medicoSeleccionado = Medico::findOrFail(
                $request->medico_id
            );

            $citasMedico = $medicoSeleccionado->citas()
                ->with(['paciente', 'consultorio'])
                ->orderBy('fecha', 'desc')
                ->get();
        }

        $totalConsultas = Cita::count();

        $consultasConfirmadas = Cita::where(
            'estado', 'confirmada'
        )->count();

        $consultasPendientes = Cita::where(
            'estado', 'pendiente'
        )->count();

        $consultasCanceladas = Cita::where(
            'estado', 'cancelada'
        )->count();

        $consultasCompletadas = Cita::where(
            'estado', 'completada'
        )->count();

        return view('citas.historial', compact(
            'pacientes',
            'medicos',
            'pacienteSeleccionado',
            'medicoSeleccionado',
            'citasPaciente',
            'citasMedico',
            'totalConsultas',
            'consultasConfirmadas',
            'consultasPendientes',
            'consultasCanceladas',
            'consultasCompletadas'
        ));
    }
}
