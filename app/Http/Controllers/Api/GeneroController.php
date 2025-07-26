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
     *     summary="Listar géneros",
     *     tags={"Género"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de géneros"
     *     )
     * )
     */
    public function index()
    {
        return Genero::all();
    }
}
