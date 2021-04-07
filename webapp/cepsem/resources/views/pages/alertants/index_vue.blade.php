@extends('layouts.layout')

@section('pagename')
Alertants
@endsection

@section('header')
    <header-component></header-component>
@endsection

@section('content')

<table-component taula="alertants" :camps="['ID', 'Telèfon', 'Nom', 'Cognoms', 'Adreça', 'Municipi', 'Tipus']" :afegir="true"></table-component>

@endsection
