@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-10">
    <div class="bg-white rounded-2xl shadow-lg w-96 p-6">

        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">
            Editar Login
        </h2>

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div>
                <label class="block text-gray-700">Nombre</label>
                <input type="text" name="name" 
                    value="{{ old('name', $user->name) }}"
                    class="w-full border rounded-lg px-3 py-2" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Correo --}}
            <div>
                <label class="block text-gray-700">Correo</label>
                <input type="email" name="email" 
                    value="{{ old('email', $user->email) }}"
                    class="w-full border rounded-lg px-3 py-2" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Contraseña (opcional) --}}
            <div>
                <label class="block text-gray-700">Nueva contraseña (opcional)</label>
                <input type="password" name="password"
                    class="w-full border rounded-lg px-3 py-2">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Rol --}}
            <div>
                <label class="block text-gray-700">Rol</label>
                <select name="role" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="admin" {{ old('role', $user->role)=='admin' ? 'selected' : '' }}>Admin</option>
                    <option value="estilista" {{ old('role', $user->role)=='estilista' ? 'selected' : '' }}>Estilista</option>
                    <option value="recepcionista" {{ old('role', $user->role)=='recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Estado login --}}
            <div>
                <label class="block text-gray-700">Estado</label>
                <select name="estado_login" class="w-full border rounded-lg px-3 py-2" required>
                    <option value="1" {{ old('estado_login', $user->estado_login)==1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('estado_login', $user->estado_login)==0 ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('estado_login')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botones --}}
            <div class="flex justify-between mt-6">
                <a href="{{ route('users.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">
                    Volver
                </a>

                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
                    Actualizar
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
