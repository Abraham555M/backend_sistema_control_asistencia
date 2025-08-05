<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request){
       $request->validate([
            'usr_usuario' => 'required',
            'pas_usuario' => 'required'
        ]);

        $user = User::where('usr_usuario', $request->usr_usuario)->first();

        if (!$user || !Hash::check($request->pas_usuario, $user->pas_usuario)) {
            return ResponseHelper::unauthorized('Credenciales inválidas');
        }

        $token = $user->createToken('token-permisos')->plainTextToken;

        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ];

        return ResponseHelper::success($data, 'Inicio de sesión exitoso');
    }

    public function crearCuenta(Request $request){
        $request->validate([
            "id_empleado" => 'required',
            "usr_usuario" => 'required|unique:usuario,usr_usuario',
            "pas_usuario" => 'required'
        ]);

        // Crear el usuario con contraseña hasheada
        $usuario = User::create([
            'id_empleado' => $request->id_empleado,
            'id_rol_usuario' => 1,
            'usr_usuario' => $request->usr_usuario,
            'pas_usuario' => Hash::make($request->pas_usuario)
        ]);

        // Verificar manualmente la contraseña
        if (!Hash::check($request->pas_usuario, $usuario->pas_usuario)) {
            return response()->json([
                'status' => false,
                'message' => 'Error al autenticar después de crear la cuenta'
            ], 401);
        }

        // Generar token con Sanctum
        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Usuario creado y autenticado',
            'data' => [
                'user' => $usuario,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]
        ]);
    }
}
