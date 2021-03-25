<?php

use App\Http\Controllers\AlertantController;
use App\Http\Controllers\IncidenciaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/login', function () {
    return view('pages.login');
});


Route::resource('incidencies', IncidenciaController::class);
Route::resource('alertants', AlertantController::class);
