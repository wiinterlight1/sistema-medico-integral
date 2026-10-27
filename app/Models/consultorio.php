<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class consultorio extends Model
{
    protected $table = 'consultorios';
    protected $fillable = ['numero', 'ubicacion', 'activo'];

    public function citas(){
        return $this->hasMany(cita::class, 'consultorio_id', 'id');
    }
}
