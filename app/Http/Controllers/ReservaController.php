<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateReservaRequest;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        $hoy = Carbon::today();
        $hora = Carbon::parse($request->hora);

        if ($hora->isSameDay($hoy) || $hora->lt($hoy)) {
            return abort(403, 'El día seleccionado ya ha pasado o es hoy');
        }

        $existe = Reserva::where('pista_id', $request->pista_id)
            ->where('user_id', Auth::id())
            ->where('fecha_hora', $hora)
            ->exists();

        if ($existe) {
            return abort(403,'Pista ocupada');
        }

        Reserva::create([
            'pista_id' => $request->pista_id,
            'user_id' => Auth::id(),
            'fecha_hora' => $hora
        ]);

        return redirect()->route('pistas.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservaRequest $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $reserva = Reserva::where('pista_id', $request->pista_id)
            ->where('fecha_hora', $request->hora)->first();

        if ($reserva->user_id == Auth::id())
        {
            Reserva::where('pista_id', $request->pista_id)
            ->where('fecha_hora', $request->hora)
            ->delete();

            return redirect()->route('pistas.index');
        }

        return abort(403, 'Esta reserva no pertenece al usuario logueado');
    }
}
