<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\PasswordCreation;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function validarToken($token)
    {
        $registro = PasswordCreation::where('token', $token)->first();

        if (!$registro || now()->diffInHours($registro->created_at) > 48) {
            return response()->json(['message' => 'Token inválido o expirado'], 400);
        }

        $empleado = Empleado::find($registro->id_empleado);

        return ResponseHelper::success($empleado, 'Token válido');
    }
}
