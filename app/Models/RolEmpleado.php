<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolEmpleado extends Model
{
    Use HasFactory;
    protected $table = "rol_empleado";
    protected $primaryKey = "id_rol_empleado";

    protected $fillable = ["nom_rol_empleado"];

    public function empleados()
    {
        return $this->hasMany(
            Empleado::class,
            'id_rol_empleado',
            'id_rol_empleado'
        );
    }
}
