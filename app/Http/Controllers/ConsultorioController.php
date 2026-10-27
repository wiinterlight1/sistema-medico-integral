<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultorio;

class ConsultorioController extends Controller
{
    // MOSTRAR CONSULTORIOS
    public function GetConsultorio()
    {
        $consultorios = Consultorio::all();

        return view('consultorios', compact('consultorios'));
    }

    // REGISTRAR CONSULTORIO
    public function CreateConsultorio(Request $request)
    {
        $datos = $request->validate([
            'numero' => 'required',
            'ubicacion' => 'required|string|max:255',
        ]);

        $datos['activo'] = 1;

        Consultorio::create($datos);

        return redirect('/consultorios')
            ->with('mensaje', 'Consultorio registrado correctamente');
    }

    public function UpdateConsultorio(Request $request, int $id)
    {
        $consultorio = Consultorio::findOrFail($id);

        $datos = $request->validate([
            'numero' => 'required',
            'ubicacion' => 'required|string|max:255',
            'activo' => 'required|boolean',
        ]);

        $consultorio->update($datos);

        return redirect('/consultorios')
            ->with('mensaje', 'Consultorio actualizado correctamente');
    }

 
    public function DeleteConsultorio(int $id)
    {
        $consultorio = Consultorio::findOrFail($id);

        $consultorio->delete();

        return redirect('/consultorios')
            ->with('mensaje', 'Consultorio eliminado correctamente');
    }
}
