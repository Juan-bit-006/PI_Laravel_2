<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
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
        'hora'       => 'required', //|date_format:H:i
        'estado'     => 'required|in:pendiente,confirmada,completada,cancelada',
    ]);

    //  Verificar si el empleado ya tiene una reserva en la misma fecha y hora
    $reservaExistente = Reserva::where('user_id', $request->user_id)
        ->where('fecha', $request->fecha)
        ->where('hora', $request->hora)
        ->whereIn('estado', ['pendiente', 'confirmada']) // solo reservas activas
        ->exists();

    if ($reservaExistente) {
        return back()->withErrors([
            'error' => 'El empleado ya tiene una reserva en esa franja horaria.'
        ])->withInput();
    }

    //  Crear la reserva si no hay conflicto
    Reserva::create($request->all());

    return redirect()->route('reservas.index')
        ->with('success', 'Reserva creada con éxito.');
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
        'hora'       => 'required', //|date_format:H:i
        'estado'     => 'required|in:pendiente,confirmada,completada,cancelada',
    ]);

    //  Validar si existe otra reserva con mismo user, fecha y hora
    $conflicto = Reserva::where('user_id', $request->user_id)
        ->where('fecha', $request->fecha)
        ->where('hora', $request->hora)
        ->whereIn('estado', ['pendiente', 'confirmada'])
        ->where('id', '!=', $reserva->id) // ignorar la reserva actual
        ->exists();

    if ($conflicto) {
        return back()->withErrors([
            'error' => 'El empleado ya tiene una reserva en ese horario.'
        ])->withInput();
    }

    $reserva->update($request->only([
        'cliente_id', 'servicio_id', 'user_id', 'fecha', 'hora', 'estado'
    ]));

    return redirect()->route('reservas.index')
        ->with('success', 'Reserva actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada con éxito.');
    }
    
    public function exportarPDF()
    {
    $reservas = \App\Models\Reserva::with(['cliente', 'servicio', 'user'])->get();
    $pdf = Pdf::loadView('reservas.pdf', compact('reservas'))
              ->setPaper('a4', 'landscape');

    return $pdf->download('reservas.pdf');
    }

    public function searchAjax(Request $request)
{
    $query = Reserva::with(['cliente', 'servicio', 'user']);

    if ($request->filled('search')) {
        $search = $request->input('search');

        $query->whereHas('cliente', fn($q) => $q->where('nombre', 'like', "%{$search}%"))
              ->orWhereHas('servicio', fn($q) => $q->where('nombre', 'like', "%{$search}%"))
              ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%{$search}%"))
              ->orWhere('fecha', 'like', "%{$search}%");
    }

    $reservas = $query->get();

    return response()->json([
        'html' => view('reservas.partials.table', compact('reservas'))->render()
    ]);
}

}

