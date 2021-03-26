<?php

namespace App\Http\Controllers;

use App\Models\Alertant;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AlertantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alertants = DB::table('alertants')
            ->select('alertants.id', 'alertants.telefon', 'alertants.nom', 'alertants.cognoms', 'alertants.adreca', 'municipis.nom as municipi', 'tipus_alertants.tipus as tipus')
            ->join('municipis', 'municipis_id', '=', 'municipis.id')
            ->join('tipus_alertants', 'tipus_alertants_id', '=', 'tipus_alertants.id')
            ->orderBy('alertants.nom')
            ->paginate(10);

        $tipusAlertants = DB::table('tipus_alertants')
            ->select('id', 'tipus')
            ->orderBy('tipus')
            ->get();

        $provincies = DB::table('provincies')
        ->select('id', 'nom')
        ->orderBy('nom')
        ->get();

        $comarques = DB::table('comarques')
        ->select('id', 'nom', 'provincies_id')
        ->orderBy('nom')
        ->get();

        $municipis = DB::table('municipis')
        ->select('id', 'nom', 'comarques_id')
        ->orderBy('nom')
        ->get();

        return view('pages.alertants.index', compact('alertants', 'tipusAlertants', 'provincies', 'comarques', 'municipis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alertant  $alertant
     * @return \Illuminate\Http\Response
     */
    public function show(Alertant $alertant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alertant  $alertant
     * @return \Illuminate\Http\Response
     */
    public function edit(Alertant $alertant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alertant  $alertant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alertant $alertant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alertant  $alertant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alertant $alertant)
    {
        //
    }
}
