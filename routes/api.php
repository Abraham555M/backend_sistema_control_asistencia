<?php
use App\Http\Controllers\Api\GeneroController;

Route::prefix('/generos')->group(function () {
    Route::get('/', [GeneroController::class, 'index']);

});

