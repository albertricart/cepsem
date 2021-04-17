<?php

namespace App\Http\Controllers;

use App\Http\Resources\IncidenciaResource;
use App\Models\Incidencia;
use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.cecos.incidencies.index');
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
     * @param  \App\Models\Incidencia  $incidency
     * @return \Illuminate\Http\Response
     */
    public function show($idincidencia)
    {
        return view('pages.cecos.incidencies.incidencia', compact('idincidencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidency
     * @return \Illuminate\Http\Response
     */
    public function edit(Incidencia $incidency)
    {
        //
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
        //
    }
}
