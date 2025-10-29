@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-gray-900 text-white">
    <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-3xl shadow-2xl p-8 w-full max-w-md text-center">
        <h1 class="text-3xl font-bold mb-6">Bienvenido a Alejandra AC</h1>
        <p class="text-gray-300 mb-8">Inicia sesión para acceder al sistema de gestión de peluquería.</p>

        <a href="{{ route('login') }}" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
            Iniciar Sesión
        </a>
    </div>
</div>
@endsection
