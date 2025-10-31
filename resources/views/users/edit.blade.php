@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-10">
    <div class="bg-white rounded-2xl shadow-lg w-96 p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Editar Empleado</h2>

        {{-- Formulario para actualizar el usuario --}}
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700">Nombre</label>
                <input type="text" name="name" 
                       value="{{ old('name', $user->name) }}" 
                       class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block text-gray-700">Correo</label>
                <input type="email" name="email" 
                       value="{{ old('email', $user->email) }}" 
                       class="w-full border rounded-lg px-3 py-2" required>
            </div>

            <div>
                <label class="block text-gray-700">Rol</label>
                <select name="role" class="w-full border rounded-lg px-3 py-2">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="estilista" {{ $user->role == 'estilista' ? 'selected' : '' }}>Estilista</option>
                    <option value="recepcionista" {{ $user->role == 'recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700">Contraseña (dejar en blanco si no deseas cambiarla)</label>
                <input type="password" name="password" class="w-full border rounded-lg px-3 py-2">
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('users.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">Cancelar</a>
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
