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
            ></textarea>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Precio</label>
            <input 
                type="number" 
                step="0.01" 
                name="precio" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required
            >
        </div>

        <div class="flex justify-center">
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
