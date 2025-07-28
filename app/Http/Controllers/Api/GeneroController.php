<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/generos",
     *     summary="Obtiene todos los géneros",
     *     tags={"Género"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de géneros",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id_genero", type="integer", example=1),
     *                 @OA\Property(property="nom_genero", type="string", example="Masculino")
     *             )
     *         )
     *     )
     * )
     */

    public function index()
    {
        return Genero::all();
    }
}
