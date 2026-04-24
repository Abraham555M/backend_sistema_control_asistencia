<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
    Use HasFactory;
    protected $table = "rol_usuario";
    protected $primaryKey = "id_rol_usuario";

    protected $fillable = ["nom_rol_usuario"];

    public function empleados()
    {
        return $this->hasMany(
            Empleado::class,
            'id_rol_usuario',
            'id_rol_usuario'
        );
    }
}
