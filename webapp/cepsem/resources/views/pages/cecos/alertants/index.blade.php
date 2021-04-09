@extends('layouts.layout')

@section('pagename')
Alertants
@endsection

@section('header')
    <header-component :formacio="true" :helpbox="false"></header-component>
@endsection

@section('content')
<div class="container-fluid my-5">
    <alertant-component taula="alertants" :camps="['ID', 'Telèfon', 'Nom', 'Cognoms', 'Adreça', 'Municipi', 'Tipus']" :afegir="true"></alertant-component>
</div>
@endsection
