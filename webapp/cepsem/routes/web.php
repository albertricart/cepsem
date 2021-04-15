<?php

use App\Http\Controllers\AfectatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecursController;
use App\Http\Controllers\UsuariController;
use SebastianBergmann\Environment\Console;
use App\Http\Controllers\AlertantController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\TipusRecursController;
use App\Http\Controllers\TipusAlertantController;
use App\Http\Controllers\TipusIncidenciaController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/cecos', function () {
    return view('pages.cecos.index');
});

Route::get('/cecos/incidencia/{id}', function ($id) {
    return redirect()->action([App\Http\Controllers\IncidenciaController::class, 'show'], ['incidency' => $id]);
});

Route::get('/cecos/incidencia', [IncidenciaController::class, 'show']);

Route::resource('/cecos/alertants', AlertantController::class);
Route::resource('/cecos/incidencies', IncidenciaController::class);
Route::resource('/cecos/usuaris', UsuariController::class);
Route::resource('/cecos/afectats', AfectatController::class);
Route::resource('/cecos/recursos-mobils', RecursController::class);
Route::resource('/cecos/tipus-recurs', TipusRecursController::class);
Route::resource('/cecos/tipus-incidencia', TipusIncidenciaController::class);
Route::resource('/cecos/tipus-alertant', TipusAlertantController::class);

Route::get('/login', [UsuariController::class, 'showLogin'])->name('login');
Route::post('/login', [UsuariController::class, 'login'] );
Route::get('/logout', [UsuariController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        $user = Auth::user();

        return view('login', compact('user'));
    });

});

/* Route::middleware(['admin'])->group(function () {


}); */

Route::middleware(['cecos'])->group(function () {

    /* Route::get('/cecos/tipus-recurs', function () {
        $user = Auth::user();

        return view('pages.login', compact('user'));
    });
    Route::get('/cecos/tipus-alertant', function () {
        $user = Auth::user();

        return view('pages.login', compact('user'));
    });
 */
});

Route::middleware(['recurs.mobil'])->group(function () {


});



Route::get('/clearcache', function() {

    $notice = '';

    $notice.= ' / APPLICATION';
    // Laravel Clear APPLICATION Cache On Shared Hosting
    $exitCode = Artisan::call('cache:clear');

    $notice.= ' / VIEW';
    // Laravel Clear VIEW Cache On Shared Hosting
    $exitCode = Artisan::call('view:clear');

    // $notice.= ' / ROUTE';
    // Laravel Clear ROUTE Cache On Shared Hosting
    // $exitCode = Artisan::call('route:cache');

    $notice.= ' / CONFIG';
    // Laravel Clear CONFIG Cache On Shared Hosting
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('config:cache');


    $notice.= ' cleared';

    return $notice;

});
