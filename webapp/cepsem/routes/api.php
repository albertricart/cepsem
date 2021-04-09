<?php

use App\Http\Controllers\API\AlertantController;
use App\Http\Controllers\API\IncidenciaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('alertants', AlertantController::class);
Route::apiResource('incidencies', IncidenciaController::class);
Route::apiResource('usuaris', UsuariController::class);
