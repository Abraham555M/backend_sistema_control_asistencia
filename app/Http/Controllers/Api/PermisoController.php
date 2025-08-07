<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\Permiso;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function crearPermiso(Request $request, $id_empleado){
        $empleado = Empleado::find($id_empleado);
        if (!$empleado) {
            return ResponseHelper::notFound("Empleado no encontrado");
        }

        $request->validate([
            'id_tipo_permiso'  => 'required|exists:tipo_permiso,id_tipo_permiso',
            'fch_ini_permiso' => 'required|date|after_or_equal:today',
            'fch_fin_permiso' => 'required|date|after_or_equal:fch_ini_permiso',
            'mot_permiso' => 'required|min:5|max:255'
        ]);

        $permiso = Permiso::create([
            'id_empleado' => $id_empleado,
            'id_tipo_permiso' => $request->id_tipo_permiso,
            'fch_ini_permiso' => $request->fch_ini_permiso,
            'fch_fin_permiso' => $request->fch_fin_permiso,
            'mot_permiso' => $request->mot_permiso,
            'est_permiso' => 1
        ]);

        return ResponseHelper::success($permiso, 'Permiso registrado correctamente');
    }

    public function listarPermisos(){
        $permisos = Permiso::select('id_permiso', 'id_tipo_permiso', 'fch_ini_permiso', 'fch_fin_permiso', 'est_permiso')
            ->get()
            ->where('est_permiso', 1);

        if($permisos->isEmpty()){
            return ResponseHelper::notFound( 'No se encontraron permisos activos');
        }

        return ResponseHelper::success($permisos, 'Listar permisos activos');
    }

    public function actualizarPermiso(Request $request, $id_permiso){
        $permiso = Permiso::find($id_permiso);
        if (!$permiso) {
            return ResponseHelper::notFound("Permiso no encontrado");
        }

        $request->validate([
            'id_tipo_permiso'  => 'required|exists:tipo_permiso,id_tipo_permiso',
            'fch_ini_permiso' => 'required|date|after_or_equal:today',
            'fch_fin_permiso' => 'required|date|after_or_equal:fch_ini_permiso',
            'mot_permiso' => 'required|min:5|max:255'
        ]);

        // Buscar el permiso
        $permiso = Permiso::findOrFail($id_permiso);

        // Actualizar los campos
        $permiso->update([
            'id_tipo_permiso' => $request->id_tipo_permiso,
            'fch_ini_permiso' => $request->fch_ini_permiso,
            'fch_fin_permiso' => $request->fch_fin_permiso,
            'mot_permiso' => $request->mot_permiso
        ]);

        return ResponseHelper::success($permiso, 'Permiso actualizado correctamente');
    }

    public function eliminarPermiso($id_permiso){
        $permiso = Permiso::find($$id_permiso);
        if (!$permiso) {
            return ResponseHelper::notFound("Permiso no encontrado");
        }

        $permiso -> est_empleado = 0;
        $permiso -> save();

        return ResponseHelper::success($permiso, 'Permiso eliminado correctamente');
    }

    public function filtrarPermisoPorFecha(Request $request)
    {
        $fecha = $request->query('fecha'); // Obtiene el valor de la url
        if(!$fecha){
            return ResponseHelper::validation('La fecha es requerida');
        }

        $permisos = Permiso::whereDate('fch_ini_permiso', '<=', $fecha)
                            ->whereDate('fch_fin_permiso', '>=', $fecha)
                            ->get();
        if($permisos->isEmpty()){
            return ResponseHelper::notFound('No se encontraron permisos en ese rango de fechas');
        }

        return ResponseHelper::success($permisos, 'Permisos filtrados por fecha');
    }

    public function filtrarPermisoPorTipo(Request $request)
    {
        $tipo = $request->query('tipo'); // Obtiene el valor de la url
        if(!$tipo){
            return ResponseHelper::validation('El tipo es requerido');
        }

        $permisos = Permiso::where('id_tipo_permiso', $tipo)->get();

        if($permisos->isEmpty()){
            return ResponseHelper::notFound('No se encontraron permisos para ese tipo');
        }

        return ResponseHelper::success($permisos, 'Permisos filtrados por tipo');
    }

}
