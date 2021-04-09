@extends('layouts.layout')

@section('pagename')
Alertants
@endsection

@section('header')
    <header-component :formacio="true" :helpbox="false" :logged="true"></header-component>
@endsection

@section('content')
<div class="container-fluid my-5">
    <alertant-component></alertant-component>
</div>
@endsection
