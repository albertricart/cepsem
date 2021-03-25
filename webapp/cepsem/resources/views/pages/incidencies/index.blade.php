@extends('layouts.layout')

@section('pagename')
Incidències
@endsection

@section('content')

<div class="container my-5">


    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Telèfon</th>
                <th scope="col">Nom</th>
                <th scope="col">Cognom</th>
                <th scope="col">Adreça</th>
                <th scope="col">Municipi</th>
                <th scope="col">Tipus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($incidencies as $incidencia)
            <tr>
                <th scope="row">{{ $alertant->telefon }}</th>
                <td>{{ $alertant->nom }}</td>
                <td>{{ $alertant->cognoms }}</td>
                <td>{{ $alertant->adreca }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>




</div>



@endsection
