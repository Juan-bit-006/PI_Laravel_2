@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Nuevo Servicio</h1>

    <form action="{{ route('servicios.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium mb-1">Nombre</label>
            <input 
                type="text" 
                name="nombre" 
                value="{{ old('nombre') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required
            >
            @error('nombre')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Descripción</label>
            <textarea 
                name="descripcion" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                rows="3"
            >{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Precio</label>
            <input 
                type="number" 
                step="0.01" 
                name="precio" 
                value="{{ old('precio') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required
            >
            @error('precio')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Duración (minutos)</label>
            <input 
                type="number" 
                name="duracion" 
                value="{{ old('duracion') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required
            >
            @error('duracion')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('servicios.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                Cancelar
            </a>

            <button 
                type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-200"
            >
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection
