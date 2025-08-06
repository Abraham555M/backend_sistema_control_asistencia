<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\RolUsuario;
use Illuminate\Http\Request;

class RolUsuarioController extends Controller
{
    public function listarRolUsuario(){
        $rol_usuario = RolUsuario::select('id_rol_usuario', 'nom_rol_usuario')->get();
        return ResponseHelper::success($rol_usuario, "Lista de roles de usuario");
    }
}
