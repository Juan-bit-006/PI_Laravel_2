@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Listado de Clientes</h1>
        <div class="space-x-3">
            <a href="{{ route('clientes.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition duration-200">
               Nuevo Cliente
            </a>
            <a href="{{ route('clientes.pdf') }}" 
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
                    <th class="px-4 py-2 text-left border-b">Teléfono</th>
                    <th class="px-4 py-2 text-left border-b">Email</th>
                    <th class="px-4 py-2 text-center border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $cliente->id }}</td>
                    <td class="px-4 py-2 border-b">{{ $cliente->nombre }}</td>
                    <td class="px-4 py-2 border-b">{{ $cliente->telefono }}</td>
                    <td class="px-4 py-2 border-b">{{ $cliente->email }}</td>
                    <td class="px-4 py-2 border-b text-center space-x-2">
                        <a href="{{ route('clientes.edit', $cliente) }}" 
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm font-medium transition duration-200">
                           Editar
                        </a>
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm font-medium transition duration-200"
                                onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">
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
