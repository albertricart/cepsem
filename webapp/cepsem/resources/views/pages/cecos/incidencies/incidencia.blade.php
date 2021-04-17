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
    @if ($idincidencia)
        <incidenciaform-component :idincidencia="{{ $idincidencia }}"></incidenciaform-component>
    @else
        <incidenciaform-component :idincidencia="-1"></incidenciaform-component>
    @endif
@endsection
