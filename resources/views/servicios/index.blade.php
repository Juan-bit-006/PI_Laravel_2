@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Listado de Servicios</h1>
        <div class="space-x-3">
            <a href="{{ route('servicios.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-200">
               Nuevo Servicio
            </a>
            <a href="{{ route('servicios.pdf') }}" 
               class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-200">
               Exportar PDF
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left border-b">ID</th>
                    <th class="px-4 py-2 text-left border-b">Nombre</th>
                    <th class="px-4 py-2 text-left border-b">Descripción</th>
                    <th class="px-4 py-2 text-left border-b">Precio</th>
					<th class="px-4 py-2 border-b">Duración</th>
                    <th class="px-4 py-2 text-center border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servicios as $servicio)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $servicio->id }}</td>
                    <td class="px-4 py-2 border-b">{{ $servicio->nombre }}</td>
                    <td class="px-4 py-2 border-b">{{ $servicio->descripcion }}</td>
                    <td class="px-4 py-2 border-b">${{ number_format($servicio->precio, 2) }}</td>
					<td class="px-4 py-2 border-b">{{ $servicio->duracion }} min</td>
                    <td class="px-4 py-2 border-b text-center space-x-2">
                        <a href="{{ route('servicios.edit', $servicio) }}" 
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm font-medium transition duration-200">
                           Editar
                        </a>
                        <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm font-medium transition duration-200"
                                onclick="return confirm('¿Seguro que deseas eliminar este servicio?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
