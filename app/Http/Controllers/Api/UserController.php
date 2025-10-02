<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\PasswordCreation;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request){
       $request->validate([
            'usr_usuario' => 'required',
            'pas_usuario' => 'required'
        ]);

        $usuario = User::where('usr_usuario', $request->usr_usuario)->first();

        if (!$usuario || !Hash::check($request->pas_usuario, $usuario->pas_usuario)) {
            return ResponseHelper::unauthorized('Credenciales inválidas');
        }

        // Verificar si el empleado asociado existe y está activo
        $empleado = $usuario->empleado;

        if (!$empleado || $empleado->est_empleado == 0) {
            return ResponseHelper::unauthorized('No tiene acceso al sistema');
        }

        // Crear token
        $token = $usuario->createToken('token_login_user')->plainTextToken;

        $data = [
            'access_token' => $token,
            'user' => $usuario
        ];

        return ResponseHelper::success($data, 'Inicio de sesión exitoso');
    }

    public function crearCuenta(Request $request){
        $request->validate([
            'token' => 'required|exists:password_creations,token',
            'usr_usuario' => 'required|string|unique:usuario,usr_usuario|max:8|alpha_num',
            'pas_usuario' => 'required|min:6|max:30|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
        ]);

        $registro = PasswordCreation::where('token', $request->token)->first();
        if (!$registro || now()->diffInHours($registro->created_at) > 48) {
            return response()->json(['message' => 'Token inválido o expirado'], 400);
        }

        // Crear el usuario con contraseña hasheada
        $usuario = User::create([
            'id_empleado' => $registro->id_empleado,
            'usr_usuario' => $request->usr_usuario,
            'pas_usuario' => Hash::make($request->pas_usuario) // Encryptar
        ]);

        // Eliminar el token para evitar reuso
        PasswordCreation::where('token', $request->token)->delete();

        // Crear token Sanctum
        $token = $usuario->createToken('token_create_user')->plainTextToken;

        $data = [
            'access_token' => $token,
            'user' => $usuario
        ];

        return ResponseHelper::success($data, 'Cuenta creada correctamente');
    }

    public function logout(Request $request){
        // Revoca solo el token actual
        $request->user()->currentAccessToken()->delete();

        return ResponseHelper::success(null, 'Sesión cerrada correctamente');
    }


}
