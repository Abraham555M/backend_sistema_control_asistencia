<?php

namespace App\Helpers;
use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function success($data = null, $message = 'Operación exitosa', $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function paginated($data, $message = 'Datos paginados correctamente', $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data->items(),
            'pagination' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
            ]
        ], $code);
    }

    public static function error($message = 'Error de procesamiento', $code = 400, $errors = null): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors
        ], $code);
    }

    public static function validation($errors, $message = 'Error de validación', $code = 422): JsonResponse
    {
        return self::error($message, $code, $errors);
    }

    public static function notFound($message = 'Recurso no encontrado'): JsonResponse
    {
        return self::error($message, 404);
    }

    public static function unauthorized($message = 'No autorizado'): JsonResponse
    {
        return self::error($message, 401);
    }

    public static function forbidden($message = 'Acceso denegado'): JsonResponse
    {
        return self::error($message, 403);
    }

    public static function conflict($message = 'Conflicto de datos'): JsonResponse
    {
        return self::error($message, 409);
    }

    public static function noContent($message = 'Sin contenido'): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
        ], 204);
    }

    public static function serverError($message = 'Error interno del servidor'): JsonResponse
    {
        return self::error($message, 500);
    }
}
