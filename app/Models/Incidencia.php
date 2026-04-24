<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $table = 'incidencia';
    protected $primaryKey = 'id_incidencia';

    protected $fillable = [
        'id_empleado',
        'id_tipo_incidencia',
        'id_empleado_revision',
        'fch_incidencia',
        'des_incidencia',
        'est_incidencia'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }
    public function tipoIncidencia()
    {
        return $this->belongsTo(TipoIncidencia::class, 'id_tipo_incidencia', 'id_tipo_incidencia');
    }
    public function empleadoRevision()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado_revision', 'id_empleado');
    }
}
