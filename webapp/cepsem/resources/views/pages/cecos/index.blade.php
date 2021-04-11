@extends('layouts.layout')

@section('pagename')
CECOS
@endsection

@section('header')
@if (Auth::check())
    <header-component username="{{ Auth::user()->nom }}" :formacio="true" :helpbox="true"></header-component>
@else
    <header-component :formacio="true" :helpbox="true"></header-component>
@endif

@endsection

@section('content')
<div class="container-xl">
    <div class="row mt-5">
        <div class="col-6">
            <div class="cepsem-card cepsem-card--lg">INCIDÈNCIES</div>
        </div>

        <div class="col-6">
            <div class="row">
                <div class="col-12">
                    <div class="cepsem-card cepsem-card--sm">RECURSOS MÒBILS</div>
                </div>

                <div class="col-12">
                    <a href="{{ url('/cecos/alertants') }}" class="cepsem-card cepsem-card--sm">ALERTANTS</a>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="cepsem-card cepsem-card--sm">USUARIS</div>
        </div>

        <div class="col-6">
            <div class="cepsem-card cepsem-card--sm">ALTRES</div>
        </div>

    </div>
</div>


@endsection
