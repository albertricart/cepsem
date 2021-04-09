@extends('layouts.layout')

@section('pagename')
Usuaris
@endsection

@section('content')

<div class="form-container custom-card my-5">

    <h2 class="textBlue mb-4" style="font-weight: 700">Usuari</h2>

    <div class="form-grid">
        <div class="input input--col">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" placeholder="Introdueix el nom de l'usuari...">
        </div>

        <div class="input input--col">
            <label for="cognoms">Cognoms</label>
            <input type="text" name="cognoms" id="cognoms" placeholder="Introdueix els cognoms de l'usuari...">
        </div>

        <div class="input input--col">
            <label for="usuari">Usuari</label>
            <input type="text" name="username" id="username" placeholder="Introdueix el usuari...">
        </div>

        <div class="input input--col">
            <label for="contrasenya">Contrasenya</label>
            <input type="text" name="contrasenya" id="contrasenya" placeholder="Introdueix la contrasenya de l'usuari...">
        </div>

        <div class="input input--col">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Introdueix el email de l'usuari...">
        </div>

        <div class="input input--col">
            <label for="rol">Rol</label>
            <select name="rol" id="rol" class="select">
                <option value="null" selected="true" disabled="disabled">Selecciona el rol d'usuari...</option>
                @foreach ($rols as $rol)
                <option value="{{ $rol->id }}">{{ $rol->nom }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mt-5">
        <a href="" class="button button-icon button--rounded button--blue mr-2"
            style="background-image: url({{ asset('assets/icons/add.svg') }})">Afegir</a>
        <a href="" class="button button-icon button--rounded button--pink"
            style="background-image: url({{ asset('assets/icons/cancel.svg') }})">Cancel·lar</a>
    </div>


</div>


<div class="container-fluid my-5">
    <h1 class="page-title">Usuaris</h1>

    <div class="d-flex justify-content-end">
        <a href="" class="button button-icon button--pink"
            style="background-image: url({{ asset('assets/icons/add.svg') }})">AFEGEIX UN NOU USUARI</a>
    </div>

    <div class="table-responsive  py-4">
        <table class="table table-hover">
            <thead>
                <tr class="table-danger">
                    <th scope="col">Nom</th>
                    <th scope="col">Cognoms</th>
                    <th scope="col">Usuari</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rol</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuaris as $usuari)
                <tr class="table-info py-5">
                    <th scope="row">{{ $usuari->nom }}</th>
                    <td>{{ $usuari->cognoms }}</td>
                    <td>{{ $usuari->username }}</td>
                    <td>{{ $usuari->email }}</td>
                    <td>{{ $usuari->rol }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $usuaris->links() }}
    </div>

</div>
