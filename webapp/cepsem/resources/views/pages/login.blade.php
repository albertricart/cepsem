@extends('layouts.layout')


@section('pagename')
Login
@endsection

@section('content')

<div class="login">
    <div style="padding-top: 150px">
        <div class="form-container form-container--small custom-card">
            <h2>Iniciar Sessió</h2>

            <form action="{{ url('/login') }}">
                <div class="input input--col mb-4">
                    <label for="username">Usuari</label>
                    <input type="text" name="username" id="username" placeholder="Introdueix el teu usuari...">
                </div>

                <div class="input input--icon input--col" style="margin-bottom: 12px">
                    <label for="password">Contrasenya</label>
                    <div class="input-icon">
                        <input type="password" name="password" id="password"
                            placeholder="Introdueix la teva contrasenya...">
                        <img class="icon" src="{{ asset('assets/icons/visibility.svg') }}" alt="">
                    </div>
                </div>
                <div class="input-error input-error--show">
                    <img src="{{ asset('assets/icons/alert.svg') }}" alt="" width="18px" height="18px"
                        style="margin-bottom: auto">
                    <span>Lorem ipsum</span>
                </div>
                <button type="submit" class="button button--pink">INICIAR SESSIÓ</button>
            </form>
        </div>
    </div>

</div>
@endsection
