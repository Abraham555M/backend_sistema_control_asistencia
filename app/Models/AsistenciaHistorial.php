<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsistenciaHistorial extends Model
{
    use HasFactory;

    protected $table = 'asistencia_historial';
    protected $primaryKey = 'id_asistencia_historial';

    protected $fillable = [
        'id_empleado',
        'fch_asistencia_historial',
        'hor_tra_asistencia_historial',
        'horas_trabajadas_totales'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }   
}
