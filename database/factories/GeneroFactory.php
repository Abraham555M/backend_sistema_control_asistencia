<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class GeneroFactory extends Factory
{
    protected static $generos = [
        'Masculino',
        'Femenino',
        'Otro'
    ];
    public function definition(): array
    {
        $genero = array_shift(self::$generos);
        return [
            'nom_genero' => $genero,
        ];
    }
}
