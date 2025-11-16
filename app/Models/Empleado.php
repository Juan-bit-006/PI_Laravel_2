<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'telefono',
        'especialidad',
        'turno',
        'estado_empleado',
        'fecha_ingreso',
    ];

    public function login()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
