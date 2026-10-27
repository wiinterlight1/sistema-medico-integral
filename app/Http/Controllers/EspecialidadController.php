<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EspecialidadController extends Controller
{
    // MOSTRAR Y BUSCAR ESPECIALIDADES
    public function getEspecialidades(Request $request)
    {
        $buscar = $request->input('buscar');

        $especialidades = Especialidad::query()
            ->when($buscar, function ($consulta) use ($buscar) {
                $consulta->where(function ($query) use ($buscar) {
                    $query->where('nombre', 'like', "%{$buscar}%")
                        ->orWhere('descripcion', 'like', "%{$buscar}%");
                });
            })
            ->get();

        return view('especialidades', compact('especialidades'));
    }

    // REGISTRAR ESPECIALIDAD
    public function createEspecialidad(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidades,nombre',
            'descripcion' => 'nullable|string',
        ]);

        Especialidad::create($datos);

        return redirect('/especialidades')
            ->with('success', 'Especialidad registrada correctamente');
    }

    // ACTUALIZAR ESPECIALIDAD
    public function updateEspecialidad(Request $request, Especialidad $especialidad)
    {
        $datos = $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('especialidades', 'nombre')
                    ->ignore($especialidad->id),
            ],
            'descripcion' => 'nullable|string',
        ]);

        $especialidad->update($datos);

        return redirect('/especialidades')
            ->with('success', 'Especialidad actualizada correctamente');
    }

    // ELIMINAR ESPECIALIDAD
    public function deleteEspecialidad(Especialidad $especialidad)
    {
        // Comprobar si tiene médicos registrados
        if ($especialidad->medicos()->exists()) {
            return redirect('/especialidades')->withErrors([
                'especialidad' => 'No se puede eliminar una especialidad con médicos registrados.'
            ]);
        }

        // Eliminar especialidad sin médicos
        $especialidad->delete();

        return redirect('/especialidades')
            ->with('success', 'Especialidad eliminada correctamente');
    }
}
