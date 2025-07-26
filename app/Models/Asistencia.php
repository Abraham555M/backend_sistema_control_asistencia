<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencia';
    protected $primaryKey = 'id_asistencia';

    protected $fillable = [
        'id_empleado',
        'hor_asistencia',
        'hor_tot_asistencia',
        'obs_asistencia',
        'est_asistencia' // Asistio, Tardanza o Falta
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }
}
