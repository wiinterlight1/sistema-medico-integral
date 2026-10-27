<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PacienteController extends Controller
{
    // MOSTRAR Y BUSCAR PACIENTES
    public function getPacientes(Request $request)
    {
        $buscar = $request->input('buscar');

        $pacientes = Paciente::with('citas')
            ->when($buscar, function ($consulta) use ($buscar) {
                $consulta->where(function ($query) use ($buscar) {
                    $query->where('nombre', 'like', "%{$buscar}%")
                        ->orWhere('apellido', 'like', "%{$buscar}%")
                        ->orWhere('telefono', 'like', "%{$buscar}%")
                        ->orWhere('correo', 'like', "%{$buscar}%");
                });
            })
            ->get();

        return view('pacientes', compact('pacientes'));
    }

    // REGISTRAR PACIENTE
    public function createPaciente(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:25',
            'correo' => 'nullable|email|unique:pacientes,correo',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
        ]);

        // Todo paciente nuevo comienza activo
        $datos['activo'] = 1;

        Paciente::create($datos);

        return redirect('/pacientes')
            ->with('success', 'Paciente registrado correctamente');
    }

    // ACTUALIZAR PACIENTE
    public function updatePaciente(Request $request, Paciente $paciente)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:25',
            'correo' => [
                'nullable',
                'email',
                Rule::unique('pacientes', 'correo')
                    ->ignore($paciente->id),
            ],
            'fecha_nacimiento' => 'required|date|before_or_equal:today',

            // Estado del paciente: 1 activo, 0 inactivo
            'activo' => 'sometimes|required|boolean',
        ]);

        $paciente->update($datos);

        return redirect('/pacientes')
            ->with('success', 'Paciente actualizado correctamente');
    }

    // ELIMINAR PACIENTE
    public function deletePaciente(Paciente $paciente)
    {
        // Comprobar si el paciente tiene citas registradas
        if ($paciente->citas()->exists()) {
            return redirect('/pacientes')->withErrors([
                'paciente' => 'No se puede eliminar un paciente con historial de citas.'
            ]);
        }

        // Eliminar solamente pacientes sin citas
        $paciente->delete();

        return redirect('/pacientes')
            ->with('success', 'Paciente eliminado correctamente');
    }
}