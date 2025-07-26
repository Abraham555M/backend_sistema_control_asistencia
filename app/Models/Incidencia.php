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
        'fch_incidencia',
        'des_incidencia'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }
    public function tipo_incidencia()
    {
        return $this->belongsTo(TipoIncidencia::class, 'id_tipo_incidencia', 'id_tipo_incidencia');
    }
}
