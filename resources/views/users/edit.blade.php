@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-10">
    <div class="bg-white rounded-2xl shadow-lg w-96 p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Nuevo Empleado</h2>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700">Nombre</label>
                <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block text-gray-700">Correo</label>
                <input type="email" name="email" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block text-gray-700">Rol</label>
                <select name="role" class="w-full border rounded-lg px-3 py-2">
                    <option value="admin">Administrador</option>
                    <option value="estilista">Estilista</option>
                    <option value="recepcionista">Recepcionista</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700">Contraseña</label>
                <input type="password" name="password" class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('users.index') }}" 
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
