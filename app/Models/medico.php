<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class medico extends Model
{
    protected $table = 'medicos';
    protected $fillable = ['nombre', 'apellido', 'telefono', 'especialidades_id', 'activo'];

    public function especialidad(){
        return $this->belongsTo(especialidad::class, 'especialidades_id', 'id');
    }

    public function citas(){
        return $this->hasMany(cita::class, 'medico_id', 'id');
    }
}
