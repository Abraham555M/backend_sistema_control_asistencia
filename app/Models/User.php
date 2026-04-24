<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

    // Campos que se pueden llenar
    protected $fillable = [
        'usr_usuario',
        'pas_usuario',
        'id_empleado',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    // Ocultar contraseña cuando se serializa
    protected $hidden = [
        'pas_usuario',
    ];
    // Si deseas autenticar con pas_usuario como password
    public function getAuthPassword()
    {
        return $this->pas_usuario;
    }

    // Relación: este usuario pertenece a un empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'pas_usuario' => 'hashed', 
        ];
    }
}
