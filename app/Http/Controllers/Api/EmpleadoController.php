<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Mail\InvitacionCrearCuenta;
use App\Models\Empleado;
use App\Models\PasswordCreation;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str; 
class EmpleadoController extends Controller
{
    public function listarEmpleados(){
        $empleados = Empleado::select('id_empleado','nom_empleado','ape_empleado','tel_empleado','est_empleado')
            ->get()
            ->where('est_empleado',1);

        return ResponseHelper::success($empleados, 'Lista de empleados');
    }

    public function crearEmpleado(Request $request){
        $request->validate([
            'id_genero' => 'required',
            'id_rol_usuario' => 'required',
            'nom_empleado' => 'required|string|max:100',
            'ape_empleado' => 'required|string|max:100',
            'fch_nac_empleado' => 'required|date|before:today',
            'ema_empleado' => 'required|email|unique:empleado,ema_empleado',
            'doc_empleado' => 'required|string|max:8|unique:empleado,doc_empleado',
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
            'id_rol_usuario' => $request -> id_rol_usuario,
            'fch_reg_empleado' => now()->toDateString(), // Solo se guarda la fecha
            'est_empleado' => 1
        ]);

        // Generar token único
        $token = Str::random(60);

        // Guardar el token en la tabla
        PasswordCreation::create([
            'id_empleado' => $empleado->id_empleado,
            'token' => $token,
            'created_at' => now()
        ]);

        // Generar link
        $link = url("/registrar-cuenta/{$token}"); // esto lo manejarás desde el frontend

        // Enviar correo
        Mail::to($empleado->ema_empleado)->send(new InvitacionCrearCuenta($empleado, $link));

        return ResponseHelper::success($empleado, 'Empleado creado');
    }

    public function actualizarEmpleado(Request $request, $id_empleado){
        $empleado = Empleado::find($id_empleado);
        if (!$empleado) {
            return ResponseHelper::notFound("Empleado no encontrado");
        }

       $request->validate([
            'id_genero' => 'required',
            'id_rol_usuario' => 'required',

            'nom_empleado' => 'required|string|max:100',
            'ape_empleado' => 'required|string|max:100',
            'fch_nac_empleado' => 'required|date|before:today',
            // Debe ser único en la tabla, excepto para el registro actual
            'ema_empleado' => 'required|email|unique:empleado,ema_empleado,' . $id_empleado . ',id_empleado',
            'tel_empleado' => 'required|string|max:20',
        ]);

        $empleado->update([
            'nom_empleado' => $request -> nom_empleado,
            'ape_empleado' => $request -> ape_empleado,
            'fch_nac_empleado' => $request -> fch_nac_empleado,
            'ema_empleado' => $request -> ema_empleado,
            'tel_empleado' => $request -> tel_empleado,
            'id_genero' => $request -> id_genero,
            'id_rol_usuario' => $request -> id_rol_usuario,
        ]);

        return ResponseHelper::success($empleado, 'Empleado actualizado correctamente');
    }

    public function eliminarEmpleado($id_empleado){
        $empleado = Empleado::find($id_empleado);
        if (!$empleado) {
            return ResponseHelper::notFound("Empleado no encontrado");
        }

        $empleado -> est_empleado = 0;
        $empleado -> save();

        return ResponseHelper::success($empleado, 'Empleado eliminado correctamente');
    }

    public function obtenerEmpleado($id_empleado){
        $empleado = Empleado::find($id_empleado);
        if(!$empleado){
            return ResponseHelper::notFound("Empleado no encontrado");
        }

        return ResponseHelper::success($empleado, "Empleado obtenido correctamente");
    }


    
}
