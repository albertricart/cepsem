<?php

use App\Http\Controllers\AlertantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/login', function () {
    return view('pages.login');
});


Route::resource('alertants', AlertantController::class);
