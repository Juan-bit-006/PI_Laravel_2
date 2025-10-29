<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 relative overflow-hidden">

        <!-- Fondo con imagen difuminada -->
        <div class="absolute inset-0">
            <img src="{{ asset('img/fondo-peluqueria.jpg') }}" alt="Fondo"
                 class="w-full h-full object-cover opacity-30 blur-sm">
        </div>

        <!-- Capa oscura encima -->
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>

        <!-- Contenedor principal -->
        <div class="relative z-10 flex flex-col items-center justify-center w-full max-w-md">

            <!-- Tarjeta del formulario -->
            <div class="w-full bg-gray-900 bg-opacity-80 rounded-3xl shadow-2xl border border-pink-500/40 
                        backdrop-blur-lg p-10 text-white">

                <!-- Logo -->
                <div class="flex flex-col items-center mb-6">
                    <img src="{{ asset('img/logo.png') }}" 
                         alt="Logo Alejandra C" 
                         class="w-24 h-24 rounded-full shadow-lg border-2 border-pink-400 mb-3">
                    <h1 class="text-3xl font-bold text-pink-400 text-center">Alejandra C Peluquería</h1>
                    <p class="text-sm text-gray-400 mt-1 text-center">Bienvenida al sistema de gestión</p>
                </div>

                <!-- Formulario -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">
                            Correo electrónico
                        </label>
                        <input id="email" type="email" name="email" required autofocus
                            class="w-full px-4 py-2.5 bg-gray-800 border border-pink-500/50 rounded-xl text-gray-100 
                                   focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition duration-300">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-1">
                            Contraseña
                        </label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-2.5 bg-gray-800 border border-pink-500/50 rounded-xl text-gray-100 
                                   focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition duration-300">
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between text-sm text-gray-400">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="mr-2 rounded border-gray-600 bg-gray-800 focus:ring-pink-500">
                            Recuérdame
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-pink-400 hover:text-pink-300 transition">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <!-- Botón -->
                    <button type="submit"
                        class="w-full py-3 bg-pink-600 hover:bg-pink-500 rounded-xl font-semibold text-white 
                               tracking-wide shadow-md shadow-pink-500/30 transition duration-300">
                        Iniciar sesión
                    </button>
                    <!-- Mensaje de error -->
                    @if ($errors->any())
                        <div class="mt-4 p-3 bg-red-600 bg-opacity-30 border border-red-500 text-red-200 rounded-lg text-center">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Registro -->
                    <!--@if (Route::has('register'))
                        <p class="text-center text-sm text-gray-400 mt-4">
                            ¿No tienes cuenta?
                            <a href="{{ route('register') }}" class="text-pink-400 hover:text-pink-300 font-medium">
                                Regístrate aquí
                            </a>
                        </p>
                    @endif -->
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
