<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RolEmpleado>
 */
class RolEmpleadoFactory extends Factory
{
    protected static $roles = [
        'Administrador',
        'Usuario'
    ];
    public function definition(): array
    {
        $rol = array_shift(self::$roles);
        return [
            'nom_rol_empleado' => $rol,
        ];
    }
}
