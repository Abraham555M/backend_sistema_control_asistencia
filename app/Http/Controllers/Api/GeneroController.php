<?php
namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function listarGeneros()
    {
        $generos = Genero::select('id_genero', 'nom_genero')->get();
        return ResponseHelper::success($generos, 'Lista de generos');
    }
}
