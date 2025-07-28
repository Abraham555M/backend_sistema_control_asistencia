<?php

use App\Http\Controllers\Api\GeneroController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;


Route::get('/generos', [GeneroController::class, 'index']);
