<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Reservas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Botones -->
                <div class="flex justify-between mb-4">
                    <a href="{{ route('reservas.create') }}"
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                        Nueva Reserva
                    </a>
                    <a href="#"
                       class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Exportar PDF
                    </a>
                </div>

                <!-- Tabla -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Cliente</th>
                                <th class="px-4 py-2">Servicio</th>
                                <th class="px-4 py-2">Empleado</th>
                                <th class="px-4 py-2">Fecha</th>
                                <th class="px-4 py-2">Hora</th>
                                <th class="px-4 py-2">Estado</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($reservas as $reserva)
                                <tr>
                                    <td class="px-4 py-2 text-gray-900 dark:text-gray-100">
    {{ $reserva->cliente->nombre ?? 'N/A' }}
</td>
<td class="px-4 py-2 text-gray-900 dark:text-gray-100">
    {{ $reserva->servicio->nombre ?? 'N/A' }}
</td>
<td class="px-4 py-2 text-gray-900 dark:text-gray-100">
    {{ $reserva->user->name ?? 'N/A' }}
</td>
<td class="px-4 py-2 text-gray-900 dark:text-gray-100">
    {{ $reserva->fecha }}
</td>
<td class="px-4 py-2 text-gray-900 dark:text-gray-100">
    {{ $reserva->hora }}
</td>
                                        <span class="px-2 py-1 rounded 
                                            @if($reserva->estado == 'pendiente') bg-yellow-200 text-yellow-800 
                                            @elseif($reserva->estado == 'confirmada') bg-green-200 text-green-800
                                            @elseif($reserva->estado == 'completada') bg-blue-200 text-blue-800
                                            @elseif($reserva->estado == 'cancelada') bg-red-200 text-red-800
                                            @endif">
                                            {{ ucfirst($reserva->estado) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 flex space-x-2">
                                        <a href="{{ route('reservas.edit', $reserva->id) }}"
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                            Editar
                                        </a>
                                        <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta reserva?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">No hay reservas registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
