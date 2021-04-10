@extends('layouts.layout')

@section('pagename')
Usuaris
@endsection

@section('header')
    <header-component :formacio="true" :helpbox="false" :logged="true"></header-component>
@endsection

@section('content')
<div class="container-fluid my-5">
    <usuari-component></usuari-component>
</div>
@endsection


