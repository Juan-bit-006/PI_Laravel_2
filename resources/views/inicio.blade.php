@extends('layouts.app')

@section('content')
<div class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 overflow-hidden">

    <!-- Imagen de fondo -->
    <div class="absolute inset-0 bg-cover bg-center opacity-40 blur-sm"
        style="background-image: url('{{ asset('img/fondo-peluqueria.jpg') }}');">
    </div>

    <div class="relative z-10 text-center p-10 bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl max-w-md w-full">
        <h1 class="text-5xl font-extrabold text-white mb-6 drop-shadow-lg">
            Alejandra AC
        </h1>
        <p class="text-gray-200 mb-8 text-lg">
            Accede a tu cuenta para gestionar clientes, servicios y reservas.
        </p>
        <a href="{{ route('login') }}" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-3 rounded-xl text-lg font-semibold shadow-lg transition duration-300">
            Iniciar Sesión
        </a>
    </div>
</div>
@endsection
