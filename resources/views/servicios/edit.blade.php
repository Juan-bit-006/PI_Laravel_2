@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Editar Servicio</h1>

    <form action="{{ route('servicios.update', $servicio) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 font-medium mb-1">Nombre</label>
            <input 
                type="text" 
                name="nombre" 
                value="{{ $servicio->nombre }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required
            >
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Descripción</label>
            <textarea 
                name="descripcion" 
                rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            >{{ $servicio->descripcion }}</textarea>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Precio</label>
            <input 
                type="number" 
                step="0.01" 
                name="precio" 
                value="{{ $servicio->precio }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required
            >
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('servicios.index') }}" 
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
