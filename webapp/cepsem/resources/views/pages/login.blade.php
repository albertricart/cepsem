@extends('layouts.layout')


<div class="form-container">
    <h1>Iniciar Sessió</h1>

    <form action="" method="POST">
        <label for="username">Usuari</label>
        <input type="text" name="username" id="username" placeholder="Introdueix el teu usuari">

        <label for="password">Contrasenya</label>
        <div class="input-icon">
            <input type="password" name="password" id="password" placeholder="Introdueix la teva contrasenya">
            <img src="{{ asset('assets/icons/alert.svg') }}" alt="">
        </div>
    </form>
</div>
