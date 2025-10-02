<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function registrarAsistencia(Request $request){
        $usuario = $request->user();

        $id_usuario = $usuario->id; 
        
        Asistencia::find($id_usuario); 
    }
}
