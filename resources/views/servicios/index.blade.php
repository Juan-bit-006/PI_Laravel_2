@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-10">
    <div class="bg-white rounded-2xl shadow-lg w-11/12 md:w-3/4 p-6">

        {{-- ENCABEZADO --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Listado de Servicios</h2>

            <div class="flex flex-wrap items-center gap-2">
                {{-- Búsqueda en tiempo real --}}
                <input type="text" id="search" placeholder="Buscar servicio..." 
                       class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 w-56 md:w-64">

                <a href="{{ route('servicios.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    Nuevo Servicio
                </a>

                <a href="{{ route('servicios.pdf') }}" 
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                    Exportar PDF
                </a>
            </div>
        </div>

        {{-- TABLA --}}
        <div id="table-container">
    @if($servicios->isEmpty())
        <div class="text-center text-gray-600 py-6">
            No hay servicios registrados.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-center">
                <thead class="bg-gray-100">
                    <tr class="text-gray-700 uppercase text-sm">
                        <th class="py-3 px-4 border-b">ID</th>
                        <th class="py-3 px-4 border-b">Nombre</th>
                        <th class="py-3 px-4 border-b">Descripción</th>
                        <th class="py-3 px-4 border-b">Precio</th>
                        <th class="py-3 px-4 border-b">Duración</th>
                        @if(auth()->user()->role === 'admin')
                            <th class="py-3 px-4 border-b">Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody id="tabla-servicios" class="bg-white">
                    @foreach ($servicios as $servicio)
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 border-b">{{ $servicio->id }}</td>
                            <td class="py-3 px-4 border-b">{{ $servicio->nombre }}</td>
                            <td class="py-3 px-4 border-b">{{ $servicio->descripcion }}</td>
                            <td class="py-3 px-4 border-b">${{ number_format($servicio->precio, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 border-b">{{ $servicio->duracion }}</td>
                            
                            {{-- Acciones solo para administradores --}}
                            @if(auth()->user()->role === 'admin')
                                <td class="py-3 px-4 border-b">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('servicios.edit', $servicio->id) }}" 
                                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm transition">
                                           Editar
                                        </a>
                                        <form action="{{ route('servicios.destroy', $servicio->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este servicio?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm transition">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    </div>
</div>

{{-- SCRIPT DE BÚSQUEDA EN TIEMPO REAL --}}
<script>
document.getElementById('search').addEventListener('keyup', function() {
    const search = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tabla-servicios tr');

    filas.forEach(fila => {
        const texto = fila.innerText.toLowerCase();
        fila.style.display = texto.includes(search) ? '' : 'none';
    });
});
</script>
@endsection
