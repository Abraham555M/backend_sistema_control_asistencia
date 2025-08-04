<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function crearPermiso(Request $request){
        $request->validate([
            'id_empleado' => 'required|exists:empleado,id_empleado',
            'fch_ini_permiso' => 'required|date|after_or_equal:today',
            'fch_fin_permiso' => 'required|date|after_or_equal:fch_ini_permiso',
            'mot_permiso' => 'required|min:5|max:255'
        ]);

        $permiso = Permiso::create([
            'id_empleado' => $request->id_empleado,
            'fch_ini_permiso' => $request->fch_ini_permiso,
            'fch_fin_permiso' => $request->fch_fin_permiso,
            'mot_permiso' => $request->mot_permiso,
            'est_permiso' => 1
        ]);

        return ResponseHelper::success($permiso, 'Permiso registrado correctamente');
    }

    public function listarPermisos(){
        $permisos = Permiso::select('id_permiso', 'fch_ini_permiso', 'fch_fin_permiso', 'est_permiso')->get();
        return ResponseHelper::success($permisos, 'Listar permisos activos');
    }

    public function actualizarPermiso(Request $request, $id_permiso){
        $request -> validate([
            'fch_ini_permiso' => 'required|date|after_or_equal:today',
            'fch_fin_permiso' => 'required|date|after_or_equal:fch_ini_permiso',
            'mot_permiso' => 'required|min:5|max:255'
        ]);
        // Buscar el permiso
        $permiso = Permiso::findOrFail($id_permiso);

        // Actualizar los campos
        $permiso->update([
            'fch_ini_permiso' => $request->fch_ini_permiso,
            'fch_fin_permiso' => $request->fch_fin_permiso,
            'mot_permiso' => $request->mot_permiso
        ]);

        return ResponseHelper::success($permiso, 'Permiso actualizado correctamente');
    }
}
