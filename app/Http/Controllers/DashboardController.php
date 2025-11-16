<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Empleado;
use App\Models\Cliente;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today()->toDateString();
        $ahora = Carbon::now();

        // Reservas del día
        $reservasHoy = Reserva::whereDate('fecha', $hoy)->count();

        // Servicios completados esta semana
        $serviciosSemana = Reserva::whereBetween('fecha', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->count();

        // Reservas próximas en la próxima hora
        $proximasReservas = Reserva::whereDate('fecha', $hoy)
            ->whereTime('hora', '>=', $ahora->format('H:i'))
            ->whereTime('hora', '<=', $ahora->copy()->addHour()->format('H:i'))
            ->with(['cliente','servicio','user'])
            ->get();

        // Empleados disponibles
        $empleadosDisponibles = Empleado::where('estado_empleado', 1)->count();

        // Clientes frecuentes
        $clientesFrecuentes = Cliente::withCount('reservas')
            ->orderBy('reservas_count', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'reservasHoy',
            'serviciosSemana',
            'proximasReservas',
            'empleadosDisponibles',
            'clientesFrecuentes'
        ));
    }
}
