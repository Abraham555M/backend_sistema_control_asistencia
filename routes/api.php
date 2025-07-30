<?php
use App\Http\Controllers\Api\GeneroController;
use App\Models\TipoIncidencia;

Route::prefix('/generos')->group(function () {
    Route::get('/lista-generos', [GeneroController::class, 'listarGenero']);
    Route::post('/crear-genero', [GeneroController::class, 'crearGenero']); 

});

Route::prefix('/tipo_incidencia')->group(function(){
    Route::get('/lista-tipo-incidencia', [TipoIncidencia::class, 'listaTipoIncidencia']);
});

