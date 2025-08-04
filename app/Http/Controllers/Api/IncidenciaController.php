<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    public function crearIncidencia(Request $request){
        $request->validate([
            'id_empleado' => 'required|exists:empleado,id_empleado',
            'id_tipo_incidencia' => 'required|exists:tipo_incidencia,id_tipo_incidencia',
            'fch_incidencia' => 'required|date|after_or_equal:today',
            'des_incidencia' => 'required|min:5|max:255'
        ]);

        $incidencia = Incidencia::create([
            'id_empleado' => $request->id_empleado,
            'id_tipo_incidencia' => $request->id_tipo_incidencia,
            'fch_incidencia' => $request->fch_incidencia,
            'des_incidencia' => $request->des_incidencia,
        ]);

        return ResponseHelper::success($incidencia, 'Incidencia registrado correctamente');
    }

    public function listarIncidencias(){
        $permisos = Incidencia::select('id_incidencia', 'id_tipo_incidencia', 'fch_incidencia')
            ->where("est_incidencia", 1)
            ->get();
        return ResponseHelper::success($permisos, 'Listar incidencias activas');
    }

    public function eliminarIncidencia($id_incidencia){
        $incidencia = Incidencia::findOrFail($id_incidencia);

        $incidencia -> est_incidencia = 0;
        $incidencia -> save();

        return ResponseHelper::success($incidencia, 'Incidencia eliminada correctamente');
    }
}
