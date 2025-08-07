<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    public function crearIncidencia(Request $request, $id_empleado){
        $empleado = Empleado::find($id_empleado);
        if (!$empleado) {
            return ResponseHelper::notFound("Empleado no encontrado");
        }

        $request->validate([
            'id_tipo_incidencia' => 'required|exists:tipo_incidencia,id_tipo_incidencia',
            'fch_incidencia' => 'required|date|after_or_equal:today',
            'des_incidencia' => 'required|min:5|max:255'
        ]);

        $incidencia = Incidencia::create([
            'id_empleado' => $id_empleado,
            'id_tipo_incidencia' => $request->id_tipo_incidencia,
            'fch_incidencia' => $request->fch_incidencia,
            'des_incidencia' => $request->des_incidencia,
        ]);

        return ResponseHelper::success($incidencia, 'Incidencia registrado correctamente');
    }

    public function listarIncidencias(){
        $incidencias = Incidencia::select('id_incidencia', 'id_tipo_incidencia', 'fch_incidencia')
            ->where("est_incidencia", 1)
            ->get();
        if($incidencias->isEmpty()){
            return ResponseHelper::notFound( 'No se encontraron incidencias');
        }
        return ResponseHelper::success($incidencias, 'Listar incidencias activas');
    }

    public function eliminarIncidencia($id_incidencia){
        $incidencia = Incidencia::findOrFail($id_incidencia);

        $incidencia -> est_incidencia = 0;
        $incidencia -> save();

        return ResponseHelper::success($incidencia, 'Incidencia eliminada correctamente');
    }

    public function filtrarIncidenciaPorFecha(Request $request)
    {
        $fecha = $request->query('fecha'); // Obtiene el valor de la url
        if(!$fecha){
            return ResponseHelper::validation('La fecha es requerida');
        }

        $incidencias = Incidencia::where('fch_incidencia',$fecha)->get();
        if($incidencias->isEmpty()){
            return ResponseHelper::notFound('No se encontraron incidencias en ese rango de fechas');
        }

        return ResponseHelper::success($incidencias, 'Incidencias filtradas por fecha');
    }
}
