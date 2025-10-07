@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="bg-white rounded-lg shadow-lg p-8 text-center">
        <h1 class="text-4xl font-bold mb-4 text-blue-700">Bienvenido al Sistema de Reservas</h1>
        <p class="text-lg text-gray-700 mb-6">Gestiona clientes, servicios y reservas de manera eficiente.</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Registrarse</a>
        </div>
    </div>
</div>
@endsection
