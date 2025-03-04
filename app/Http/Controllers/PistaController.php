<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePistaRequest;
use App\Http\Requests\UpdatePistaRequest;
use App\Models\Pista;
use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pistas = Pista::all();

        return view('pistas.index', ['pistas' => $pistas]);
    }

    public function selector(Request $request)
    {
        $pista = Pista::find($request->pista_id);
        $hora = Carbon::today();
        $hoy = $hora->startOfWeek();
        return view('pistas.show', ['pista' => $pista, 'hoy' => $hoy, 'hora' => $hora]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePistaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pista $pista)
    {

        return view('pistas.show', ['pista' => $pista, 'reservas' => $reservas]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pista $pista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePistaRequest $request, Pista $pista)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pista $pista)
    {
        //
    }
}
