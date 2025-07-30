<?php
namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function listarGenero()
    {
        $generos = Genero::select('id_genero', 'nom_genero')->get();
        return ResponseHelper::success($generos, 'Lista de generos');
    }
    public function crearGenero(Request $request){
        $request->validate([
            'nom_genero' => 'required'
        ]);

        $genero = Genero::create([
            'nom_genero' => $request->nom_genero,
        ]);

        return ResponseHelper::success($genero, 'Genero creado correctamente');
    }
}
