@extends('layouts.layout')

@section('pagename')
Incidència
@endsection

@section('header')
@if (Auth::check())
<header-component username="{{ Auth::user()->nom }}" :formacio="true" :helpbox="true"></header-component>
@else
<header-component :formacio="true" :helpbox="true"></header-component>
@endif

@endsection

@section('content')
    @if ($idincidencia == -1)
        <incidenciaform-component :insert="true" :tipusalertants="{{ $tipusAlertants }}" :provincies="{{ $provincies }}" :tipusincidents="{{ $tipusIncidents }}"></incidenciaform-component>
    @else
        <incidenciaform-component :idincidencia="{{ $idincidencia }}"  :insert="false" :tipusalertants="{{ $tipusAlertants }}" :provincies="{{ $provincies }}" :tipusincidents="{{ $tipusIncidents }}"></incidenciaform-component>
    @endif
@endsection
