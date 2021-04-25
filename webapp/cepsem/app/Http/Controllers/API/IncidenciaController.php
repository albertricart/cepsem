<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\IncidenciaResource;
use App\Models\Incidencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Classes\Utilitat;
use Illuminate\Support\Facades\DB;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return IncidenciaResource::collection(Incidencia::all());
        return IncidenciaResource::collection(Incidencia::with(['afectats', 'tipus_incidencia', 'recursos', 'municipi.comarca.provincia', 'alertant', 'usuari'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Utilitat::checkIncidencia($request);

        //si tots els camps obligatoris han estat omplerts
        if ($response == "") {
            $incidencia = Utilitat::getIncidencia($request);

            try {
                DB::beginTransaction();
                $incidencia->save();


                $incidencia_has_recursos = $request->input('incidencia_has_recursos');

                $i = 0;
                while ($response == "" && $i < count($incidencia_has_recursos)) {
                    $incidencia_has_recurs = $incidencia_has_recursos[$i];

                    $response = Utilitat::checkIncidenciaHasRecurs($incidencia_has_recurs);

                    //si tots els camps obligatoris de incidencia_has_recurs han estat omplerts
                    if ($response == "") {
                        $incidencia_has_recurs = Utilitat::getIncidenciaHasRecurs($incidencia_has_recurs);
                        $incidencia_has_recurs->save();

                        //afegirem l'afectat en cas que no existeixi



                        //afegirem l'alertant en cas que no existeixi



                    }else{
                        DB::rollBack();
                    }

                    $i++;
                }

                DB::commit();
                $incidencia->update();

            } catch (QueryException $e) {
                DB::rollBack();
                $response = \response(['errorMessage' => Utilitat::handleErrorMessage($e)], 400);
            }
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidency
     * @return \Illuminate\Http\Response
     */
    public function show(Incidencia $incidency)
    {
        return new IncidenciaResource(Incidencia::with(['tipus_incidencia','usuari', 'municipi.comarca.provincia','alertant.municipi.comarca.provincia','incidencia_has_recursos.recurs', 'incidencia_has_recursos.afectat'])->find($incidency->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incidencia  $incidency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incidencia $incidency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incidencia  $incidency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incidencia $incidency)
    {
        try {
            $incidency->delete();
            $response = \response()->json(['message' => "Incidència esborrada correctament"], 200);
        } catch (QueryException $e) {
            $response = \response()->json(['errorMessage' => Utilitat::handleErrorMessage($e)], 400);
        }

        return $response;
    }
}
