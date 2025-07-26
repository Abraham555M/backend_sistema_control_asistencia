<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horario';
    protected $primaryKey = 'id_horario';

    protected $fillable = [
        'id_empleado',
        'hor_lun_horario',
        'hor_mar_horario',
        'hor_mie_horario',
        'hor_jue_horario',
        'hor_vie_horario',
        'hor_sab_horario',
        'hor_dom_horario',
        'hor_sem_horario',
        'dia_sem_horario',
        'est_horario'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }
}
