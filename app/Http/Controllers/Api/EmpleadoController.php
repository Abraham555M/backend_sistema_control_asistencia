<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function listarEmpleados(){
        $empleados = Empleado::select('id_empleado','nom_empleado','ape_empleado','tel_empleado','est_empleado')->get();
        return ResponseHelper::success($empleados, 'Lista de empleados');
    }

    public function crearEmpleado(Request $request){
        $request->validate([
            'id_genero' => 'required',

            'nom_empleado' => 'required|string|max:100',
            'ape_empleado' => 'required|string|max:100',
            'fch_nac_empleado' => 'required|date|before:today',
            'ema_empleado' => 'required|email',
            'doc_empleado' => 'required|string|max:8',
            'tel_empleado' => 'required|string|max:20',
        ]);

        $empleado = Empleado::create([
            'nom_empleado' => $request -> nom_empleado,
            'ape_empleado' => $request -> ape_empleado,
            'fch_nac_empleado' => $request -> fch_nac_empleado,
            'ema_empleado' => $request -> ema_empleado,
            'doc_empleado' => $request -> doc_empleado,
            'tel_empleado' => $request -> tel_empleado,
            'id_genero' => $request -> id_genero,
            'fch_reg_empleado' => now()->toDateString(), // Solo se guarda la fecha
            'est_empleado' => 1
        ]);

        return ResponseHelper::success($empleado, 'Empleado creado');
    }
}
