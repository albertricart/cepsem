@extends('layouts.layout')

@section('pagename')
    Alertants
@endsection

@section('content')

<div class="container-fluid my-5">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr class="table-danger">
                    <th scope="col">Telèfon</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Cognom</th>
                    <th scope="col">Adreça</th>
                    <th scope="col">Municipi</th>
                    <th scope="col">Tipus</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alertants as $alertant)
                <tr class="table-info py-5" >
                    <th scope="row">{{ $alertant->telefon }}</th>
                    <td>{{ $alertant->nom }}</td>
                    <td>{{ $alertant->cognoms }}</td>
                    <td>{{ $alertant->adreca }}</td>
                    <td>{{ $alertant->municipi }}</td>
                    <td>{{ $alertant->tipus }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>



@endsection
