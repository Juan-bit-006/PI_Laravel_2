<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\User;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('login')->get(); // opcional si agregas relación
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        // Logins disponibles para asignar (solo activos)
        $logins = User::where('estado_login', 1)
              ->whereDoesntHave('empleado')
              ->get();

        return view('empleados.create', compact('logins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'        => 'required|string|max:255',
            'apellido'      => 'nullable|string|max:255',
            'telefono'      => 'nullable|string|max:20',
            'especialidad'  => 'nullable|string|max:255',
            'turno'         => 'nullable|string|max:255',
            'fecha_ingreso' => 'nullable|date',
            'user_id'       => 'nullable|exists:users,id',
            'estado_empleado' => 'required|boolean',
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado creado correctamente.');
    }

    public function edit(Empleado $empleado)
    {
        // Logins disponibles + el login ya asignado
        $logins = User::where('estado_login', 1)
              ->whereDoesntHave('empleado')
              ->orWhere('id', $empleado->user_id)
              ->get();

        return view('empleados.edit', compact('empleado','logins'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'apellido'     => 'nullable|string|max:255',
            'telefono'     => 'nullable|string|max:20',
            'especialidad' => 'nullable|string|max:255',
            'turno'        => 'nullable|string|max:255',
            'user_id'      => 'nullable|exists:users,id',
            'estado_empleado' => 'required|boolean',
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado actualizado correctamente.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado eliminado.');
    }

    public function exportPdf()
    {
        $empleados = Empleado::with('login')->get();

        $pdf = Pdf::loadView('empleados.pdf', compact('empleados'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('reporte_empleados_' . now()->format('Ymd_His') . '.pdf');
    }


}
