<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    // Mostrar médicos
    public function GetMedicos()
    {
        $medicos = Medico::with('especialidad')->get();
        $especialidades = Especialidad::all();

        return view('medicos', compact('medicos', 'especialidades'));
    }

    // Registrar médico
    public function CreateMedicos(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'required|string|max:25',
            'especialidad_id' => 'required|exists:especialidades,id',
            'activo' => 'required|boolean',
        ]);

        Medico::create([
            'nombre' => $datos['nombre'],
            'apellido' => $datos['apellido'],
            'telefono' => $datos['telefono'],
            'especialidades_id' => $datos['especialidad_id'],
            'activo' => $datos['activo'],
        ]);

        return redirect('/medicos')
            ->with('mensaje', 'Médico agregado correctamente.');
    }

    // Actualizar médico
    public function UpdateMedico(Request $request, int $id)
{
    $medico = Medico::findOrFail($id);

    $request->validate([
        'nombre' => 'required',
        'apellido' => 'required',
        'telefono' => 'required',
        'especialidad_id' => 'required|exists:especialidades,id',
        'activo' => 'required'
    ]);
    $medico->update([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'telefono' => $request->telefono,
        'especialidades_id' => $request->especialidad_id, 
        'activo' => $request->activo,
    ]);

    return redirect('/medicos')->with('mensaje', 'Médico actualizado correctamente.');
}

   public function DeleteMedico(int $id)
{
    $medico = Medico::findOrFail($id);

    $tieneCitasActivas = Cita::where('medico_id', $id)
        ->where('estado', '!=', 'cancelada')
        ->exists();

    if ($tieneCitasActivas) {
        return redirect('/medicos')->withErrors([
            'medico' => 'No se puede eliminar este médico porque tiene citas activas registradas.'
        ]);
    }

    Cita::where('medico_id', $id)
        ->where('estado', 'cancelada')
        ->delete();

    $medico->delete();

    return redirect('/medicos')
        ->with('mensaje', 'Médico eliminado correctamente.');
}
}
