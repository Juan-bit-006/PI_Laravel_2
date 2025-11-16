@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-10">
    <div class="bg-white rounded-2xl shadow-lg w-96 p-6">

        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Nuevo Empleado</h2>

        <form action="{{ route('empleados.store') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Nombre --}}
            <div>
                <label class="block text-gray-700">Nombre</label>
                <input type="text" name="nombre" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            {{-- Apellido --}}
            <div>
                <label class="block text-gray-700">Apellido</label>
                <input type="text" name="apellido" class="w-full border rounded-lg px-3 py-2">
            </div>

            {{-- Teléfono --}}
            <div>
                <label class="block text-gray-700">Teléfono</label>
                <input type="text" name="telefono" class="w-full border rounded-lg px-3 py-2">
            </div>

            {{-- Especialidad --}}
            <div>
                <label class="block text-gray-700">Especialidad</label>
                <input type="text" name="especialidad" class="w-full border rounded-lg px-3 py-2">
            </div>

            {{-- Turno --}}
            <div>
                <label class="block text-gray-700">Turno</label>
                <input type="text" name="turno" class="w-full border rounded-lg px-3 py-2">
            </div>

            {{-- Fecha de ingreso --}}
            <div>
                <label class="block text-gray-700">Fecha de ingreso</label>
                <input type="date" name="fecha_ingreso" class="w-full border rounded-lg px-3 py-2">
            </div>


            {{-- Estado --}}
            <div>
                <label class="block text-gray-700">Estado</label>
                <select name="estado_empleado" class="w-full border rounded-lg px-3 py-2">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>

            {{-- Login (opcional) --}}
            <div>
                <label class="block text-gray-700">Asignar Login (opcional)</label>
                <select name="user_id" class="w-full border rounded-lg px-3 py-2">
                    <option value="">Sin login</option>
                    @foreach ($logins as $login)
                        <option value="{{ $login->id }}">{{ $login->email }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Botones --}}
            <div class="flex justify-between mt-6">
                <a href="{{ route('empleados.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">Cancelar</a>

                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
                    Guardar
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
