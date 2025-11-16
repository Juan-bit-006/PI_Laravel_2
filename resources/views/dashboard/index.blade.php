@extends('layouts.app')

@section('content')
<div class="p-8 space-y-10">

    {{-- Título --}}
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Panel de Control</h1>
        <p class="text-gray-500 dark:text-gray-400 flex items-center gap-1">
            {{ now()->format('d M Y') }}
        </p>
    </div>

    {{-- Tarjetas resumen --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="bg-blue-50 border border-blue-200 p-6 rounded-2xl shadow-sm hover:shadow-md transition">
            <h2 class="text-lg font-semibold text-gray-700">Reservas del día</h2>
            <p class="text-4xl font-bold text-blue-600 mt-3">{{ $reservasHoy }}</p>
        </div>

        <div class="bg-green-50 border border-green-200 p-6 rounded-2xl shadow-sm hover:shadow-md transition">
            <h2 class="text-lg font-semibold text-gray-700">Servicios completados (semana)</h2>
            <p class="text-4xl font-bold text-green-600 mt-3">{{ $serviciosSemana }}</p>
        </div>

        <div class="bg-indigo-50 border border-indigo-200 p-6 rounded-2xl shadow-sm hover:shadow-md transition">
            <h2 class="text-lg font-semibold text-gray-700">Reservas próximas (1 hora)</h2>
            <p class="text-4xl font-bold text-indigo-600 mt-3">{{ $proximasReservas->count() }}</p>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 p-6 rounded-2xl shadow-sm hover:shadow-md transition">
            <h2 class="text-lg font-semibold text-gray-700">Empleados disponibles</h2>
            <p class="text-4xl font-bold text-yellow-600 mt-3">{{ $empleadosDisponibles }}</p>
        </div>
    </div>

    <div class="bg-indigo-50 border border-indigo-200 p-6 rounded-2xl shadow-sm hover:shadow-md transition">
        <h2 class="text-lg font-semibold text-gray-700">Reservas próximas (1 hora)</h2>
        <p class="text-4xl font-bold text-indigo-600 mt-3">
        {{ $proximasReservas->count() }}
        </p>
    </div>


        <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-sm text-gray-600">Cliente</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-600">Servicio</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-600">Empleado</th>
                    <th class="px-4 py-2 text-left text-sm text-gray-600">Hora</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proximasReservas as $r)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="px-4 py-2">{{ $r->cliente->nombre }}</td>
                        <td class="px-4 py-2">{{ $r->servicio->nombre }}</td>
                        <td class="px-4 py-2">{{ $r->user->name }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($r->hora)->format('H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-3 text-gray-500">
                            No hay reservas dentro de la próxima hora.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Seguimiento de clientes --}}
    <div class="bg-white shadow rounded-2xl p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800"> Seguimiento de clientes</h2>
        <ul class="divide-y divide-gray-200">
            @forelse ($clientesFrecuentes as $cliente)
                <li class="flex justify-between py-3">
                    <span class="font-medium text-gray-700">{{ $cliente->nombre }}</span>
                    <span class="text-sm text-gray-500">{{ $cliente->reservas_count }} reservas</span>
                </li>
            @empty
                <li class="py-3 text-gray-500">No hay clientes registrados aún.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
