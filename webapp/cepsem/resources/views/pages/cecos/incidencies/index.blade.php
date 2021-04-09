@extends('layouts.layout')

@section('pagename')
Incidències
@endsection

@section('content')
<div class="container-fluid my-5">
    {{-- <h1 class="page-title">INCIDÈNCIES</h1> --}}

    <div class="d-flex justify-content-end">
      <button class="button button-icon button--pink" style="background-image: url('../assets/icons/add.svg')">
        AFEGEIX UNA NOVA INCIDENCIA
      </button>
    </div>

    <table-component taula="incidencies" :camps="['ID', 'Telèfon', 'Nom', 'Cognoms', 'Adreça', 'Municipi', 'Tipus']"></table-component>

</div>

@endsection
