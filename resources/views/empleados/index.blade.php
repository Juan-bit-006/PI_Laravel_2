@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-10">
    <div class="bg-white rounded-2xl shadow-lg w-11/12 md:w-3/4 p-6">

        {{-- Título + Controles --}}
        <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Gestión de Empleados</h2>

            <div class="flex flex-wrap items-center gap-2">
                <input type="text" id="search" placeholder="Buscar empleado..." 
                       class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 w-56 md:w-64">

                <a href="{{ route('empleados.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
                    Nuevo Empleado
                </a>
            </div>
        </div>

        {{-- Tabla --}}
        @if($empleados->isEmpty())
            <div class="text-center text-gray-600 py-6">No hay empleados registrados.</div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 text-center">
                    <thead class="bg-gray-100">
                        <tr class="text-gray-700 uppercase text-sm">
                            <th class="py-3 px-4 border-b">ID</th>
                            <th class="py-3 px-4 border-b">Nombre</th>
                            <th class="py-3 px-4 border-b">Teléfono</th>
                            <th class="py-3 px-4 border-b">Especialidad</th>
                            <th class="py-3 px-4 border-b">Turno</th>
                            <th class="py-3 px-4 border-b">Estado</th>
                            <th class="py-3 px-4 border-b">Login Asignado</th>
                            <th class="py-3 px-4 border-b">Acciones</th>
                        </tr>
                    </thead>

                    <tbody id="tabla-empleados" class="bg-white">
    @foreach ($empleados as $empleado)
        <tr class="hover:bg-gray-50">

            {{-- ID --}}
            <td class="py-3 px-4 border-b">{{ $empleado->id }}</td>

            {{-- Nombre --}}
            <td class="py-3 px-4 border-b">{{ $empleado->nombre }}</td>

            {{-- Teléfono --}}
            <td class="py-3 px-4 border-b">{{ $empleado->telefono ?? '-' }}</td>

            {{-- Especialidad --}}
            <td class="py-3 px-4 border-b">{{ $empleado->especialidad ?? '-' }}</td>

            {{-- Turno --}}
            <td class="py-3 px-4 border-b">{{ $empleado->turno ?? '-' }}</td>

            {{-- Estado laboral --}}
            <td class="py-3 px-4 border-b">
                @if($empleado->estado_empleado == 1)
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                        Activo
                    </span>
                @else
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                        Inactivo
                    </span>
                @endif
            </td>

            {{-- Login asignado --}}
            <td class="py-3 px-4 border-b">
                @if ($empleado->login)
                    <span class="text-blue-700 font-semibold">
                        {{ $empleado->login->email }}
                    </span>
                @else
                    <span class="text-gray-500">Sin login</span>
                @endif
            </td>

            {{-- Acciones --}}
            <td class="py-3 px-4 border-b">
                <div class="flex justify-center">
                    <a href="{{ route('empleados.edit', $empleado->id) }}" 
                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm transition">
                        Editar
                    </a>
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

{{-- Script Buscador --}}
<script>
document.getElementById('search').addEventListener('keyup', function() {
    const search = this.value.toLowerCase();
    const filas = document.querySelectorAll('#tabla-empleados tr');
    filas.forEach(fila => {
        const texto = fila.innerText.toLowerCase();
        fila.style.display = texto.includes(search) ? '' : 'none';
    });
});
</script>
@endsection
