<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TipoPermisoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static $tipos = [
        'Permiso personal',
        'Cita médica',
        'Fallecimiento familiar',
        'Permiso por estudios',
        'Día libre autorizado',
        'Tardanza justificada',
        'Licencia sin goce',
        'Permiso por maternidad'
    ];
    public function definition(): array
    {
       $tipo = array_shift(self::$tipos);
        return [
            'nom_tipo_permiso' => $tipo,
        ];
    }
}
