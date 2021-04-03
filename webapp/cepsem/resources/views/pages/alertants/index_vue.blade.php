@extends('layouts.layout')

@section('pagename')
Alertants
@endsection

@section('content')

<alertants-component></alertants-component>

{{-- <div class="form-container custom-card my-5">

    <h2 class="textBlue mb-4" style="font-weight: 700">Alertant</h2>

    <form action="{{ action([App\Http\Controllers\AlertantController::class, 'store']) }}" method="post">
        @csrf
        <div class="form-grid">
            <div class="input input--col">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" placeholder="Introdueix el nom de l'alertant..."
                    value="{{ old('nom') }}">
            </div>

            <div class="input input--col">
                <label for="cognoms">Cognoms</label>
                <input type="text" name="cognoms" id="cognoms" placeholder="Introdueix els cognoms de l'alertant..."
                    value="{{ old('cognoms') }}">
            </div>

            <div class="input input--col">
                <label for="telefon">Telèfon</label>
                <input type="text" name="telefon" id="telefon" placeholder="Introdueix el telèfon de l'alertant..."
                    required value="{{ old('telefon') }}">
            </div>

            <div class="input input--col">
                <label for="adreca">Adreça</label>
                <input type="text" name="adreca" id="adreca" placeholder="Introdueix l'adreça de l'alertant..."
                    value="{{ old('adreca') }}">
            </div>

            <div class="input input--col">
                <label for="tipus">Tipus</label>
                <select name="tipus" id="tipus" class="select" required>
                    <option value="null" selected="true" disabled="disabled">Selecciona el tipus d'alertant...</option>

                    @foreach ($tipusAlertants as $tipusAlertant)

                        @if (session('tipus') == $tipusAlertant->id)
                            <option value="{{ $tipusAlertant->id }}" selected="true">{{ $tipusAlertant->tipus }}</option>
                        @else
                            <option value="{{ $tipusAlertant->id }}">{{ $tipusAlertant->tipus }}</option>
                        @endif

                    @endforeach
                </select>
            </div>

            <div class="input input--col">
                <label for="provincia">Provincia</label>
                <select id="provincia" class="select">
                    <option value="null" selected="true" disabled="disabled">Selecciona la provincia on es troba...
                    </option>
                    @foreach ($provincies as $provincia)
                    <option value="{{ $provincia->id }}">{{ $provincia->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input input--col">
                <label for="comarca">Comarca</label>
                <select id="comarca" class="select">
                    <option value="null" selected="true" disabled="disabled">Selecciona la comarca on es troba...
                    </option>
                    @foreach ($comarques as $comarca)
                    <option value="{{ $comarca->id }}">{{ $comarca->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input input--col">
                <label for="municipi">Municipi</label>
                <select name="municipi" id="municipi" class="select">
                    <option value="null" selected="true" disabled="disabled">Selecciona el municipi on es troba...
                    </option>
                    @foreach ($municipis as $municipi)
                    <option value="{{ $municipi->id }}">{{ $municipi->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mt-5">
            <button type="submit" class="button button-icon button--rounded button--blue mr-2"
                style="background-image: url({{ asset('assets/icons/add.svg') }})">Afegir</button>
            <a href="" class="button button-icon button--rounded button--pink"
                style="background-image: url({{ asset('assets/icons/cancel.svg') }})">Cancel·lar</a>
        </div>
    </form>





</div> --}}








@endsection
