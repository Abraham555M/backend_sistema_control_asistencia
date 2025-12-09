<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Asistencia;
use App\Models\Horario;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function registrarAsistencia(Request $request){
        $empleado = $request->user(); // Se obteniene todo el request
        $id_empleado = $empleado->id_empleado; 

        $horario = Horario::get()
        ->where("id_empleado", $id_empleado);

        if($horario->isEmpty()){
            return ResponseHelper::notFound("No cuenta con un horario"); 
        }
        
      
        
        Asistencia::find(); 
    }
}
