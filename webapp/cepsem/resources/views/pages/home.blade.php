@extends('layouts.layout')

@section('pagename')
Home
@endsection


@section('content')

<div class="home">
    <div class="home-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-7">
                    <h1>Benvingut...</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                        dolore eu
                        fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                        deserunt mollit anim id est laborum.</p>
                </div>

                <div class="col-sm-5">
                    <div class="home-header__img"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="home-body">
        <a href="{{ url('cecos') }}" class="home-option home-option__cecos">
            <h2><b>CE</b>NTRAL DE <b>CO</b>ORDINACIÓ <b>S</b>ANITÀRIA</h2>
            <img src="{{ asset('assets/img/cecos/cecos1.jpg') }}" alt="">
        </a>

        <a href="{{ url('recursosmobils') }}" class="home-option home-option__rm">
            <h2>RECURSOS MÒBILS</h2>
            <img src="{{ asset('assets/img/rm/rm1.jpg') }}" alt="">
        </a>
    </div>


</div>

@endsection
