@extends('layouts.layout')

@section('pagename')
Tipus Recurs
@endsection

@section('header')
    <header-component :formacio="true" :helpbox="false" :logged="true"></header-component>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Recurs</h4>


    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Tipus</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
            @foreach ($tipusRecurs as $recurs)
                <tr>
                    <th scope="row">{{ $recurs->id }}</th>
                    <td>{{ $recurs->tipus }}</td>

                    <td>
                        <button type="submit" id="myBtn" class="btn btn-danger float-right" data-toggle="modal" data-target="#modal{{ $recurs->id }}"><i class="fas fa-trash-alt"></i>Esborrar</button>

                        <form action="{{ action([App\Http\Controllers\TipusRecursController::class, 'edit'], ['tipus_recur' => $recurs->id]) }}" method="get">
                            @csrf
                            <button type="submit" class="btn btn-secondary float-right"><i class="far fa-edit"></i>Editar</button>
                        </form>


                        {{-- MODAL ELIMINAR --}}
                        <div class="modal" id="modal{{ $recurs->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Esborrar Recurs</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <p>Estas segur de que vols esborrar el recurs {{ $recurs->tipus }}</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>Tancar</button>
                                  <form action="{{ action([App\Http\Controllers\TipusRecursController::class, 'destroy'], ['tipus_recur' => $recurs->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger float-right"><i class="fas fa-trash-alt"></i>Esborrar</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>


                          {{-- MODAL CREAR --}}
                          <div class="modal" id="modalCrear" tabindex="-1" role="dialog">
                                <form action="{{ action([App\Http\Controllers\TipusRecursController::class, 'store']) }}" method="POST">
                                @csrf
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">

                                  <h5 class="modal-title">Recurs</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label class="col-2" for="sigles">Tipus</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="tipus" id="tipus">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>Tancar</button>
                                    <button type="submit" class="btn btn-danger float-right" ><i class="fas fa-trash-alt"></i>Aceptar</button>
                                </div>
                              </div>
                            </div>
                        </form>
                          </div>

                          {{-- MODAL UPDATE --}}
                          <div class="modal" id="modalCrear" tabindex="-1" role="dialog">
                            <form action="{{ action([App\Http\Controllers\TipusRecursController::class, 'update'], ['tipus_recur' => $recurs->id]) }}" method="POST">
                            @csrf
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">

                              <h5 class="modal-title">Recurs</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-2" for="sigles">Tipus</label>
                                    <div class="col-10">
                                        <input class="form-control" type="text" name="tipus" id="tipus" value="{{ old('tipus') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>Tancar</button>
                                <button type="submit" class="btn btn-danger float-right" ><i class="fas fa-trash-alt"></i>Aceptar</button>
                            </div>
                          </div>
                        </div>
                    </form>
                      </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>


@endsection

<a class="btn btn-primary flotante" data-toggle="modal" data-target="#modalCrear"><i class="fas fa-plus" ></i>Nou recurs</a>


