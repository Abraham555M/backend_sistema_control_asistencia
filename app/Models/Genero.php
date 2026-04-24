<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $table = 'genero';
    protected $primaryKey = 'id_genero';

    protected $fillable = ['nom_genero'];

    public function empleados()
    {
        return $this->hasMany(
            Empleado::class,
            'id_genero',
            'id_genero'
        );
    }
}
