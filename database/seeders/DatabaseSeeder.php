<?php

namespace Database\Seeders;

use App\Models\Genero;
use App\Models\RolUsuario;
use App\Models\TipoIncidencia;
use App\Models\TipoPermiso;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\TipoPermisoFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
        Genero::factory()->count(3)->create();
        TipoIncidencia::factory()->count(8)->create();
        RolUsuario::factory()->count(2)->create();
        TipoPermiso::factory()->count(8)->create();

    }
}
