<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteController extends Controller
{
    /**
     * Mostrar listado de clientes
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Guardar un nuevo cliente
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|unique:clientes,email',
        ]);

        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente creado con éxito.');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Actualizar cliente
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
        ]);

        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado con éxito.');
    }

    /**
     * Eliminar cliente
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado con éxito.');
    }

    /**
     * Exportar listado de clientes a PDF
     */
    public function exportPdf()
    {
        $clientes = Cliente::all();
        $pdf = Pdf::loadView('clientes.pdf', compact('clientes'));
        return $pdf->download('clientes.pdf');
    }
}