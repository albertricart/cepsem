<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariController;
use App\Http\Controllers\AlertantController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\TipusRecursController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/cecos', function () {
    return view('pages.cecos.index');
});

Route::resource('/cecos/alertants', AlertantController::class);
Route::resource('/cecos/incidencies', IncidenciaController::class);
Route::resource('/cecos/usuaris', UsuariController::class);
Route::resource('/cecos/tipus-recurs', TipusRecursController::class);

Route::get('/login', [UsuariController::class, 'showLogin'])->name('login');
Route::post('/login', [UsuariController::class, 'login'] );
Route::get('/logout', [UsuariController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $user = Auth::user();

        return view('home', compact('user'));
    });

});
