@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-10">
    <div class="bg-white rounded-2xl shadow-lg w-11/12 md:w-3/4 p-6">
        
        {{-- ENCABEZADO CON BUSCADOR --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Listado de Reservas</h2>

            <div class="flex flex-wrap items-center gap-2">
                {{-- Campo de búsqueda en tiempo real --}}
                <input type="text" id="search" placeholder="Buscar reserva..." 
                       class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 w-56 md:w-64">

                {{-- Botones principales --}}
                <a href="{{ route('reservas.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    Nueva Reserva
                </a>

                <a href="{{ route('reservas.exportar.pdf') }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                    Exportar PDF
                </a>
            </div>
        </div>

        {{-- TABLA DE RESERVAS --}}
        <div id="table-container">
            @if($reservas->isEmpty())
                <div class="text-center text-gray-600 py-6">
                    No hay reservas registradas.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 text-center">
                        <thead class="bg-gray-100">
                            <tr class="text-gray-700 uppercase text-sm">
                                <th class="py-3 px-4 border-b">ID</th>
                                <th class="py-3 px-4 border-b">Cliente</th>
                                <th class="py-3 px-4 border-b">Servicio</th>
                                <th class="py-3 px-4 border-b">Usuario</th>
                                <th class="py-3 px-4 border-b">Fecha</th>
                                <th class="py-3 px-4 border-b">Hora</th>
                                <th class="py-3 px-4 border-b">Estado</th>
                                <th class="py-3 px-4 border-b">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-reservas" class="bg-white">
                            @foreach ($reservas as $reserva)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-3 px-4 border-b">{{ $reserva->id }}</td>
                                    <td class="py-3 px-4 border-b">{{ $reserva->cliente->nombre ?? 'Sin cliente' }}</td>
                                    <td class="py-3 px-4 border-b">{{ $reserva->servicio->nombre ?? 'Sin servicio' }}</td>
                                    <td class="py-3 px-4 border-b">{{ $reserva->user->name ?? 'Sin usuario' }}</td>
                                    <td class="py-3 px-4 border-b">{{ $reserva->fecha }}</td>
                                    <td class="py-3 px-4 border-b">{{ $reserva->hora }}</td>
                                    <td class="py-3 px-4 border-b">
                                        <span class="px-3 py-1 text-xs rounded-full 
                                            {{ $reserva->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ ucfirst($reserva->estado) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 border-b">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('reservas.edit', $reserva->id) }}" 
                                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm transition">
                                               Editar
                                            </a>
                                            <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta reserva?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm transition">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- SCRIPT DE BUSQUEDA EN TIEMPO REAL --}}
<script>
document.getElementById('search').addEventListener('keyup', function() {
    const search = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tabla-reservas tr');

    filas.forEach(fila => {
        const texto = fila.innerText.toLowerCase();
        fila.style.display = texto.includes(search) ? '' : 'none';
    });
});
</script>
@endsection
