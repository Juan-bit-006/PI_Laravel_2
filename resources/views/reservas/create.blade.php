@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-10">
    <div class="bg-white rounded-2xl shadow-lg w-11/12 md:w-2/4 p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Nueva Reserva</h2>

        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('reservas.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="cliente_id" class="block text-gray-700 font-medium mb-1">Cliente</label>
                <select name="cliente_id" id="cliente_id" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="servicio_id" class="block text-gray-700 font-medium mb-1">Servicio</label>
                <select name="servicio_id" id="servicio_id" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Seleccione un servicio</option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}">
                            {{ $servicio->nombre }} - {{ $servicio->descripcion }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="user_id" class="block text-gray-700 font-medium mb-1">Empleado</label>
                <select name="user_id" id="user_id" required
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Seleccione un usuario</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="fecha" class="block text-gray-700 font-medium mb-1">Fecha</label>
                <input type="date" name="fecha" id="fecha" required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="hora" class="block text-gray-700 font-medium mb-1">Hora</label>
                <input type="time" name="hora" id="hora" required
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="estado" class="block text-gray-700 font-medium mb-1">Estado</label>
                <select name="estado" id="estado"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="pendiente">Pendiente</option>
                    <option value="confirmada">Confirmada</option>
                    <option value="completada">Completada</option>
                </select>
            </div>

            <div class="flex justify-between pt-4">
                <a href="{{ route('reservas.index') }}" 
                        class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg transition">
                    Cancelar
            </a>
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg transition">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
