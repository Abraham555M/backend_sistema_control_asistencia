<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permiso';
    protected $primaryKey = 'id_permiso';

    protected $fillable = [
        'id_empleado',
        'id_tipo_permiso',
        'fch_ini_permiso',
        'fch_fin_permiso',
        'mot_permiso',
        'est_permiso'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }
    public function tipo_permiso()
    {
        return $this->belongsTo(TipoPermiso::class, 'id_tipo_permiso', 'id_tipo_permiso');
    }
}
