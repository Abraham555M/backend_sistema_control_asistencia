<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\TipoIncidencia;
use Illuminate\Http\Request;

class TipoIncidenciaController extends Controller
{
    public function selectTipoIncidencia() {
        $tipo_incidencia = TipoIncidencia::select("id_tipo_incidencia", "nom_tipo_incidencia")
                                        ->where("est_tipo_incidencia", 1)->get();
        return ResponseHelper::success($tipo_incidencia, 'Select de tipo de incidencias');
    }

    public function listarTipoIncidencia(){
        $tipo_incidencia = TipoIncidencia::select("id_tipo_incidencia", "nom_tipo_incidencia", "est_tipo_incidencia")
                                ->orderBy("est_tipo_incidencia", "desc")
                                ->get();

        return ResponseHelper::success($tipo_incidencia, "Lista de Tipo de incidencias");
    }

    public function registrarTipoIncidencia(Request $request)
    {
        $data = $request->validate([
            'nom_tipo_incidencia' => 'required|string|unique:tipo_incidencia,nom_tipo_incidencia|max:150'
        ]);

        $data['est_tipo_incidencia'] = 1;
        $tipo_incidencia = TipoIncidencia::create($data);

        return ResponseHelper::success($tipo_incidencia, "Tipo de incidencia registrada correctamente");
    }

    public function actualizarTipoIncidencia(Request $request, $id_tipo_incidencia)
    {
        $tipo_incidencia = TipoIncidencia::find($id_tipo_incidencia);

        if ($tipo_incidencia === null) {
            return ResponseHelper::notFound("Tipo de incidencia no encontrada");
        }

        $data = $request->validate([
            'nom_tipo_incidencia' => 'required|string|unique:tipo_incidencia,nom_tipo_incidencia,' . $id_tipo_incidencia . ',id_tipo_incidencia|max:150',
            'est_tipo_incidencia' => 'required|integer|in:0,1'
        ]);

        $tipo_incidencia->update($data);

        return ResponseHelper::success($tipo_incidencia, "Tipo de incidencia actualizada correctamente");
    } 
}
