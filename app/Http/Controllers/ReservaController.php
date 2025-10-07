<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::with(['cliente', 'servicio', 'user'])->get();
        return view('reservas.index', compact('reservas'));
        
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $servicios = Servicio::all();
        $usuarios = User::all(); // aquí podrías filtrar solo estilistas si usas roles

        return view('reservas.create', compact('clientes', 'servicios', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'servicio_id' => 'required|exists:servicios,id',
        'user_id'    => 'required|exists:users,id',
        'fecha'      => 'required|date|after_or_equal:today',
        'hora'       => 'required',
        'estado'     => 'required|in:pendiente,confirmada,completada,cancelada',
    ]);

    Reserva::create($request->all());

    return redirect()->route('reservas.index')->with('success', 'Reserva creada con éxito.');
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
        $clientes = Cliente::all();
        $servicios = Servicio::all();
        $usuarios = User::all();

        return view('reservas.edit', compact('reserva', 'clientes', 'servicios', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'servicio_id' => 'required|exists:servicios,id',
            'user_id'    => 'required|exists:users,id',
            'fecha'      => 'required|date|after_or_equal:today',
            'hora'       => 'required',
            'estado'     => 'required|in:pendiente,confirmada,completada,cancelada',
        ]);

        $reserva->update($request->all());

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada con éxito.');
    }
}
