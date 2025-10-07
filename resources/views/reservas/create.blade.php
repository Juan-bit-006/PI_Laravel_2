<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nueva Reserva') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('reservas.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="cliente_id" class="block font-medium">Cliente</label>
                        <select name="cliente_id" class="w-full border px-3 py-2 rounded-lg text-black">
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="servicio_id" class="block font-medium">Servicio</label>
                        <select name="servicio_id" class="w-full border px-3 py-2 rounded-lg text-black">
                            @foreach($servicios as $servicio)
                                <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="user_id" class="block font-medium">Empleado</label>
                        <select name="user_id" class="w-full border px-3 py-2 rounded-lg text-black">
                            @foreach($usuarios as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="fecha" class="block font-medium">Fecha</label>
                        <input type="date" name="fecha" class="w-full border px-3 py-2 rounded-lg text-black" required>
                    </div>

                    <div class="mb-4">
                        <label for="hora" class="block font-medium">Hora</label>
                        <input type="time" name="hora" class="w-full border px-3 py-2 rounded-lg text-black" required>
                    </div>

                    <div class="mb-4">
                        <label for="estado" class="block font-medium">Estado</label>
                        <select name="estado" class="w-full border px-3 py-2 rounded-lg text-black">
                            <option value="pendiente">Pendiente</option>
                            <option value="confirmada">Confirmada</option>
                            <option value="completada">Completada</option>
                            <option value="cancelada">Cancelada</option>
                        </select>
                    </div>

                    <div class="flex justify-between mt-6">
                        <a href="{{ route('reservas.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg">
                            Cancelar
                        </a>

                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg">
                            Guardar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
