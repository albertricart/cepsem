@extends('layouts.layout')

@section('pagename')
    Alertants
@endsection

@section('content')


<div class="container-fluid my-5">
    <h1 class="page-title">Alertants</h1>

    <div class="d-flex justify-content-end">
        <a href="" class="button button-icon button--pink" style="background-image: url({{ asset('assets/icons/add.svg') }})">AFEGEIX UN NOU ALERTANT</a>
    </div>

    <div class="table-responsive  py-4">
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
        {{ $alertants->links() }}
    </div>

</div>



@endsection
