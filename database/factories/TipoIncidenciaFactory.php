<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoIncidencia>
 */
class TipoIncidenciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static $tipos = [
        'Tardanza',
        'Inasistencia',
        'Falta justificada',
        'Permiso médico',
        'Trabajo remoto',
        'Salida anticipada',
        'Incidente laboral',
        'Permiso personal'
    ];
    public function definition(): array
    {
        // Saca un valor único del array estático y lo elimina para no repetirlo
        $tipo = array_shift(self::$tipos);
        return [
            'nom_tipo_incidencia' => $tipo,
        ];
    }
}
