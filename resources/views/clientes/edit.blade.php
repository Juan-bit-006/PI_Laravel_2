@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Editar Cliente</h1>

    <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-medium mb-1">Nombre</label>
            <input 
                type="text" 
                name="nombre" 
                value="{{ $cliente->nombre }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required
            >
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Teléfono</label>
            <input 
                type="text" 
                name="telefono" 
                value="{{ $cliente->telefono }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Email</label>
            <input 
                type="email" 
                name="email" 
                value="{{ $cliente->email }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required
            >
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('clientes.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-5 py-2 rounded-lg transition duration-200">
               Cancelar
            </a>
            <button 
                type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
