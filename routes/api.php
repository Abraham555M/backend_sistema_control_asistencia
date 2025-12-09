<?php
use App\Http\Controllers\Api\CuentaController;
use App\Http\Controllers\Api\RolUsuarioController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\GeneroController;
use App\Http\Controllers\Api\HorarioController;
use App\Http\Controllers\Api\IncidenciaController;
use App\Http\Controllers\Api\PermisoController;
use App\Http\Controllers\Api\TipoIncidenciaController;
use App\Http\Controllers\Api\TipoPermisoController;
use App\Models\TipoPermiso;

Route::prefix('/generos')->group(function () {
    Route::get('/lista-generos', [GeneroController::class, 'listarGeneros']);
    Route::post('/crear-genero', [GeneroController::class, 'crearGenero']);

});

Route::prefix('/rol-usuario')->group(function () {
    Route::get('/lista-rol-usuario', [RolUsuarioController::class, 'listarRolUsuario']);
});

Route::prefix('/tipo-incidencia')->group(function(){
    Route::get('/lista-tipo-incidencias', [TipoIncidenciaController::class, 'listarTipoIncidencias']);
});

Route::prefix('/empleados')->group(function(){
    Route::get('/lista-empleados', [EmpleadoController::class, 'listarEmpleados']);
    Route::post('/crear-empleado', [EmpleadoController::class, 'crearEmpleado']);
    Route::put('/actualizar-empleado/{id_empleado}', [EmpleadoController::class, 'actualizarEmpleado']);
    Route::delete('/eliminar-empleado/{id_empleado}', [EmpleadoController::class, 'eliminarEmpleado']);
    Route::get('/obtener-empleado/{id_empleado}', [EmpleadoController::class, 'obtenerEmpleado']);
    Route::get('/filtrar-empleado-estado/{estado}', [EmpleadoController::class, 'filtrarPorEstado']);
    Route::post('/filtrar-empleado-fecha', [EmpleadoController::class, 'filtrarPorFechaIngreso']);
    Route::post('/filtrar-empleado-nombre', [EmpleadoController::class, 'filtrarPorNombres']);
});

Route::prefix("tipo-permiso")->group(function(){
    Route::get("/lista-tipo-permiso", [TipoPermisoController::class, 'listarTipoPermiso']); 
});

Route::middleware('auth:sanctum')->prefix('/permisos')->group(function () {
    Route::get('/lista-permisos', action: [PermisoController::class, 'listarPermisos']);
    Route::post('/crear-permiso/{id_empleado}', [PermisoController::class, 'crearPermiso']);
    Route::put('/actualizar-permiso/{id_permiso}', [PermisoController::class, 'actualizarPermiso']);
    Route::delete('/eliminar-permiso/{id_permiso}', [PermisoController::class, 'eliminarPermiso']);
    Route::get('/filtrar-fecha', [PermisoController::class, 'filtrarPermisoPorFecha']);
    Route::get('/filtrar-tipo', [PermisoController::class, 'filtrarPermisoPorTipo']);
});

/**
    Route::middleware('auth:sanctum')->prefix('/permisos')->group(function () {
    Route::get('/lista-permisos', [PermisoController::class, 'listarPermisos']);
    Route::post('/crear-permiso', [PermisoController::class, 'crearPermiso']);
    Route::put('/actualizar-permiso/{id_permiso}', [PermisoController::class, 'actualizarPermiso']);
    });
*/

Route::prefix('/incidencias')->group(function(){
    Route::get('/lista-incidencias', [IncidenciaController::class, 'listarIncidencias']);
    Route::post('/crear-incidencia/{id_empleado}', [IncidenciaController::class, 'crearIncidencia']);
    Route::delete('/eliminar-incidencia/{id_incidencia}', [IncidenciaController::class, 'eliminarIncidencia']);

});

Route::prefix('/horarios')->group(function(){
    Route::get('/lista-horarios', [HorarioController::class, 'listarHorarios']);
    Route::post('/crear-horario', [HorarioController::class, 'crearHorario']);
    Route::put('/actualizar-horario/{id_horario}', [HorarioController::class, 'actualizarPermiso']);
});

Route::prefix('/auth')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/crear-cuenta', [UserController::class, 'crearCuenta']);
});

Route::middleware('auth:sanctum')->prefix('/auth')->group(function () {
       Route::post('/logout', [UserController::class, 'logout']);
});

Route::get('/validar-token/{token}', [CuentaController::class, 'validarToken']);

