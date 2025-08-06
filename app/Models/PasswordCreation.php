<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordCreation extends Model
{
    public $timestamps = false;
    protected $table = 'password_creations';

    protected $fillable = [
        'id_empleado',
        'token',
        'created_at'
    ];
}
