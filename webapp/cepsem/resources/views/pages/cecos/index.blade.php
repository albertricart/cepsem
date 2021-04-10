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
            <div class="custom-card custom-card--lg">INCIDÈNCIES</div>
        </div>

        <div class="col-6">
            <div class="row">
                <div class="col-12">
                    <div class="custom-card custom-card--sm">RECURSOS MÒBILS</div>
                </div>

                <div class="col-12">
                    <div class="custom-card custom-card--sm">ALERTANTS</div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="custom-card custom-card--sm">USUARIS</div>
        </div>

        <div class="col-6">
            <div class="custom-card custom-card--sm">ALTRES</div>
        </div>

    </div>
</div>


@endsection
