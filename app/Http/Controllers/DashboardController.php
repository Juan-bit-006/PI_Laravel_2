<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today();

        // Reservas del día
        $reservasHoy = Reserva::whereDate('fecha', $hoy)->count();

        // Servicios completados esta semana
        $serviciosSemana = Reserva::whereBetween('fecha', [
                $hoy->copy()->startOfWeek(),
                $hoy->copy()->endOfWeek()
            ])
            ->where('estado', 'completada')
            ->count();

        // Reservas próximas (dentro de la próxima hora)
        $ahora = Carbon::now();
        $enUnaHora = $ahora->copy()->addHour();

        $proximasReservas = Reserva::with(['cliente', 'servicio', 'user'])
            ->whereDate('fecha', $hoy)
            ->whereBetween('hora', [$ahora->format('H:i:s'), $enUnaHora->format('H:i:s')])
            ->orderBy('hora')
            ->get();

        $reservasProximas = $proximasReservas->count();

        // Empleados disponibles (sin reserva en la próxima hora)
        $empleadosOcupados = $proximasReservas->pluck('user_id');
        $empleadosDisponibles = User::whereNotIn('id', $empleadosOcupados)->count();

        // Seguimiento de clientes frecuentes
        $clientesFrecuentes = Cliente::withCount('reservas')
            ->orderByDesc('reservas_count')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'reservasHoy',
            'serviciosSemana',
            'reservasProximas',
            'empleadosDisponibles',
            'proximasReservas',
            'clientesFrecuentes'
        ));
    }
}
