<?php

namespace App\Http\Controllers\API;

use App\Classes\Utilitat;
use App\Models\Afectat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AfectatResource;
use Illuminate\Database\QueryException;

class AfectatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AfectatResource::collection(Afectat::with(['sexe', 'incidencies'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->checkAfectat($request);

        try {
            if (($response) == ' ') {
                $nouAfectat = $this->getAfectat($request);
                $nouAfectat->save();

                $response = (new AfectatResource($nouAfectat))
                ->response()
                ->setStatusCode(201);
            }

        } catch (QueryException $e) {
            $response = \response(['errorMessage' => Utilitat::handleErrorMessage($e)], 400);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Afectat  $afectat
     * @return \Illuminate\Http\Response
     */
    public function show(Afectat $afectat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Afectat  $afectat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Afectat $afectat)
    {
        try {
            $afectat->update([
                'telefon' => $request->input('telefon'),
                'cip' => $request->input('cip'),
                'nom' => $request->input('nom'),
                'cognoms' => $request->input('cognoms'),
                'edat' => $request->input('edat'),
                'te_cip' => $request->input('te_cip'),
                'sexes_id' => $request->input('sexes_id')
            ]);

            $response = (new AfectatResource($afectat))
                ->response()
                ->setStatusCode(204);
        } catch (QueryException $e) {
            $response = \response(['errorMessage' => Utilitat::handleErrorMessage($e)], 400);
        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Afectat  $afectat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Afectat $afectat)
    {
        try {
            $afectat->delete();
            $response = \response()->json(['message' => "Afectat esborrat correctament"], 200);
        } catch (QueryException $e) {
            $response = \response()->json(['errorMessage' => Utilitat::handleErrorMessage($e)], 400);
        }

        return $response;
    }

    public function getAfectat($request)
    {
        $afectat = new Afectat();

        $afectat->telefon = $request->input('telefon');
        $afectat->cip = $request->input('cip');
        $afectat->nom = $request->input('nom');
        $afectat->cognoms = $request->input('cognoms');
        $afectat->edat = $request->input('edat');
        $afectat->te_cip = $request->input('te_cip');
        $afectat->sexes_id = $request->input('sexes_id');

        return $afectat;
    }

    public function checkAfectat($request)
    {
        if (empty($request->input('username'))) {
            $response = \response(['errorMessage' => "El camp username és obligatori"]);
        } else if (empty($request->input('contrasenya'))) {
            $response = \response(['errorMessage' => "El camp contrasenya és obligatori"]);
        } else if (empty($request->input('email'))) {
            $response = \response(['errorMessage' => "El camp email és obligatori"]);
        } else if (empty($request->input('nom'))) {
            $response = \response(['errorMessage' => "El camp nom és obligatori"]);
        } else if (empty($request->input('cognoms'))) {
            $response = \response(['errorMessage' => "El camp cognoms és obligatori"]);
        } else if (empty($request->input('rols_id'))) {
            $response = \response(['errorMessage' => "El camp rol és obligatori"]);
        } else if (empty($request->input('recursos_id'))) {
            $response = \response(['errorMessage' => "El camp recurs és obligatori"]);
        } else {
            $response = ' ';
        }

        return $response;
    }
}
