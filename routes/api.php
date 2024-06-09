<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\CelulaController;
use App\Http\Controllers\MembroCargoController;
use App\Http\Controllers\MembroController;
use App\Http\Controllers\PresencaController;
use App\Http\Controllers\ReuniaoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/membros', [MembroController::class, 'index']);
Route::post('/membros', [MembroController::class, 'store']);
Route::get('/membros/{id}', [MembroController::class, 'show']);
Route::put('/membros/{id}', [MembroController::class, 'update']);
Route::delete('/membros/{id}', [MembroController::class, 'destroy']);

Route::get('/cargos', [CargoController::class, 'index']);
Route::post('/cargos', [CargoController::class, 'store']);
Route::get('/cargos/{id}', [CargoController::class, 'show']);
Route::put('/cargos/{id}', [CargoController::class, 'update']);
Route::delete('/cargos/{id}', [CargoController::class, 'destroy']);

Route::get('/associacoes-membros-cargos', [MembroCargoController::class, 'index']);
Route::post('/associar-membro-cargo', [MembroCargoController::class, 'associar']);
Route::delete('/desassociar-membro-cargo/{id}', [MembroCargoController::class, 'desassociar']);

Route::get('/reunioes', [ReuniaoController::class, 'index']);
Route::post('/reunioes', [ReuniaoController::class, 'store']);
Route::get('/reunioes/{id}', [ReuniaoController::class, 'show']);
Route::put('/reunioes/{id}', [ReuniaoController::class, 'update']);
Route::delete('/reunioes/{id}', [ReuniaoController::class, 'destroy']);

Route::get('/celulas', [CelulaController::class, 'index']);
Route::post('/celulas', [CelulaController::class, 'store']);
Route::get('/celulas/{id}', [CelulaController::class, 'show']);
Route::put('/celulas/{id}', [CelulaController::class, 'update']);
Route::delete('/celulas/{id}', [CelulaController::class, 'destroy']);

Route::get('/presencas', [PresencaController::class, 'index']);
Route::post('/presencas', [PresencaController::class, 'store']);
Route::get('/presencas/{id}', [PresencaController::class, 'show']);
Route::put('/presencas/{id}', [PresencaController::class, 'update']);
Route::delete('/presencas/{id}', [PresencaController::class, 'destroy']);
