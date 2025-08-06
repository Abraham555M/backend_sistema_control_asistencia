<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\TipoIncidencia;
use Illuminate\Http\Request;

class TipoIncidenciaController extends Controller
{
    public function listarTipoIncidencias(){
        $tipo_incidencia = TipoIncidencia::select('id_tipo_incidencia', 'nom_tipo_incidencia')->get();
        return ResponseHelper::success($tipo_incidencia, 'Lista de tipo de incidencias');
    }
}
