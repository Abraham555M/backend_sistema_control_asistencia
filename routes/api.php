<?php
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\GeneroController;
use App\Http\Controllers\Api\TipoIncidenciaController;

Route::prefix('/generos')->group(function () {
    Route::get('/lista-generos', [GeneroController::class, 'listarGeneros']);
    Route::post('/crear-genero', [GeneroController::class, 'crearGenero']);

});

Route::prefix('/tipo-incidencia')->group(function(){
    Route::get('/lista-tipo-incidencias', [TipoIncidenciaController::class, 'listarTipoIncidencias']);
});

Route::prefix('/empleados')->group(function(){
    Route::get('/lista-empleados', [EmpleadoController::class, 'listarEmpleados']);
    Route::post('/crear-empleado', [EmpleadoController::class, 'crearEmpleado']);

});

