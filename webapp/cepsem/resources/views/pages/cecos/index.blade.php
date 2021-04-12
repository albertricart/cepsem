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
<div class="cecos">
    <div class="container-xl">
        <div class="row mt-5">
            <div class="col-md-6">
                <menucard-component size="lg" page="incidencies" name="INCIDÈNCIES"></menucard-component>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <menucard-component size="sm" page="recursos-mobils" name="RECURSOS MÒBILS"></menucard-component>
                    </div>

                    <div class="col-md-12">
                        <menucard-component size="sm" page="alertants" name="ALERTANTS"></menucard-component>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <menucard-component size="sm" page="usuaris" name="USUARIS"></menucard-component>
            </div>

            <div class="col-md-6">
                <menucard-component size="sm" page="altres" name="ALTRES"></menucard-component>
            </div>

        </div>
    </div>
</div>

@endsection
