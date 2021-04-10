<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariController;
use App\Http\Controllers\AlertantController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\TipusAlertantController;
use App\Http\Controllers\TipusIncidenciaController;
use App\Http\Controllers\TipusRecursController;
use SebastianBergmann\Environment\Console;

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
Route::resource('/cecos/tipus-incidencia', TipusIncidenciaController::class);
Route::resource('/cecos/tipus-alertant', TipusAlertantController::class);

Route::get('/login', [UsuariController::class, 'showLogin'])->name('login');
Route::post('/login', [UsuariController::class, 'login'] );
Route::get('/logout', [UsuariController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $user = Auth::user();

        return view('/login', compact('user'));
    });

    Route::get('/cecos/usuaris', function () {
        $user = Auth::user();
        $rol = Auth::user()->rols_id;
        if ($rol == 1) {
            $view = view('pages.cecos.usuaris.index');
        }
        else
        {
            return $view = view('login', compact('user'));
        }
        return $view;
    });

    Route::get('/cecos/alertants', function () {
        $user = Auth::user();
        $rol = Auth::user()->rols_id;
        if ($rol == 1) {
            $view = view('pages.cecos.alertants.index');
        }
        else
        {
            return $view = view('login', compact('user'));
        }
        return $view;
    });

    Route::get('/cecos', function () {
        $user = Auth::user();
        $rol = Auth::user()->rols_id;
        if ($rol == 1 || $rol == 2 ||$rol == 3) {
            $view = view('pages.cecos.index');
        }
        else
        {
            return $view = view('login', compact('user'));
        }
        return $view;
    });

    /* Route::get('/cecos/tipus-recurs', function () {
        $user = Auth::user();
        $rol = Auth::user()->rols_id;
        if ($rol == 1) {
            // $view = view('pages.cecos.altres.tipusRecursos.index');
            $view = redirect()->action([TipusRecursController::class, 'index']);
        }
        else
        {
            return $view = view('login', compact('user'));
        }
        return $view;
    }); */

    /* Route::get('/cecos/tipus-alertants', function () {
        $user = Auth::user();
        $rol = Auth::user()->rols_id;
        if ($rol == 1) {
            // $view = view('pages.cecos.altres.tipusAlertant.index');
            $view = redirect()->action([TipusAlertantController::class, 'index']);
        }
        else
        {
            return $view = view('login', compact('user'));
        }
        return $view;
    }); */

    /* Route::get('/cecos/tipus-incidencia', function () {
        $user = Auth::user();
        $rol = Auth::user()->rols_id;
        if ($rol == 1) {
            // $view = view('pages.cecos.altres.tipusIncidencia.index');
            $view = redirect()->action([TipusIncidenciaController::class, 'index']);
        }
        else
        {
            return $view = view('login', compact('user'));
        }
        return $view;
    }); */

});
