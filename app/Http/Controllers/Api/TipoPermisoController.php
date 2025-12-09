<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Permiso;
use App\Models\TipoPermiso;
use Illuminate\Http\Request;

class TipoPermisoController extends Controller
{
     public function listarTipoPermiso() {
        $tipo_permiso = TipoPermiso::select("id_tipo_permiso", "nom_tipo_permiso", "est_tipo_permiso")->get();
        return ResponseHelper::success($tipo_permiso, 'Lista de tipo de permisos');
    }
}
