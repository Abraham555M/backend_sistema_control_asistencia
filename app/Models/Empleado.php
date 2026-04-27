<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleado';
    protected $primaryKey = 'id_empleado';

    protected $fillable = [
        'id_genero',
        'id_rol_empleado',
        'nom_empleado',
        'ape_empleado',
        'fch_nac_empleado',
        'ema_empleado',
        'doc_empleado',
        'tel_empleado',
        'img_empleado',
        'est_empleado',
        'fch_reg_empleado'
    ];

    public function genero()
    {
        return $this->belongsTo(Genero::class, 'id_genero', 'id_genero');
    }
    public function rolEmpleado()
    {
        return $this->belongsTo(RolEmpleado::class, 'id_rol_empleado', 'id_rol_empleado');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'id_empleado', 'id_empleado');
    }
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'id_empleado', 'id_empleado');
    }
    public function permisos()
    {
        return $this->hasMany(Permiso::class, 'id_empleado', 'id_empleado');
    }
    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'id_empleado', 'id_empleado');
    }
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_empleado', 'id_empleado');
    }
    public function asistenciasHistorial()
    {
        return $this->hasMany(AsistenciaHistorial::class, 'id_empleado', 'id_empleado');
    }
}
