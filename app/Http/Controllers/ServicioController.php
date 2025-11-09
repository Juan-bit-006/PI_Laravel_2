<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{

    public function __construct()
    {
    // Todos deben estar autenticados
    $this->middleware('auth');

    // Solo el admin puede crear, editar o eliminar
    $this->middleware('isAdmin')->except(['index']);
    }

    /**
     * Mostrar listado de servicios
     */
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('servicios.create');
    }

    /**
     * Guardar un nuevo servicio
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio'      => 'required|numeric|min:0',
            'duracion'    => 'required|integer|min:1',
        ]);

        Servicio::create($request->all());
        return redirect()->route('servicios.index')->with('success', 'Servicio creado con éxito.');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Servicio $servicio)
    {
        return view('servicios.edit', compact('servicio'));
    }

    /**
     * Actualizar un servicio
     */
    public function update(Request $request, Servicio $servicio)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio'      => 'required|numeric|min:0',
            'duracion'    => 'required|integer|min:1',
        ]);

        $servicio->update($request->all());
        return redirect()->route('servicios.index')->with('success', 'Servicio actualizado con éxito.');
    }

    /**
     * Eliminar un servicio
     */
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect()->route('servicios.index')->with('success', 'Servicio eliminado con éxito.');
    }

    /**
     * Exportar listado de servicios a PDF
     */
    public function exportPdf()
    {
        $servicios = Servicio::all();
        $pdf = Pdf::loadView('servicios.pdf', compact('servicios'));
        return $pdf->download('servicios.pdf');
    }
}