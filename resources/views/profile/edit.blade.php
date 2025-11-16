@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 space-y-10">

    {{-- TÍTULO --}}
    <h2 class="text-3xl font-semibold text-white text-center">
        Perfil del Usuario
    </h2>

    {{-- SECCIÓN: INFORMACIÓN PERSONAL --}}
    <div class="bg-gray-900 shadow border border-gray-700 rounded-xl p-6">
        <h3 class="text-xl font-semibold text-white mb-4">Información Personal</h3>

        @include('profile.partials.update-profile-information-form')
    </div>

    {{-- SECCIÓN: INFORMACIÓN LABORAL --}}
    <div class="bg-gray-900 shadow border border-gray-700 rounded-xl p-6">
        <h3 class="text-xl font-semibold text-white mb-4">Información Laboral</h3>

            @php
                $empleado = Auth::user()->empleado ?? null;
            @endphp

    <section class="mt-10">
        

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-300">

            <div>
                <p class="text-sm text-gray-400">Especialidad</p>
                <p class="text-lg">
                    {{ $empleado->especialidad ?? 'No asignada' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-400">Teléfono</p>
                <p class="text-lg">
                    {{ $empleado->telefono ?? 'No registrado' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-400">Turno asignado</p>
                <p class="text-lg">
                    {{ $empleado->turno ?? 'Sin turno' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-400">Estado del empleado</p>
                @if($empleado && $empleado->estado_empleado == 1)
                    <span class="px-3 py-1 text-sm rounded-full bg-green-200 text-green-800">
                        Activo
                    </span>
                @else
                    <span class="px-3 py-1 text-sm rounded-full bg-red-200 text-red-800">
                        Inactivo
                    </span>
                @endif
            </div>

            <div>
                <p class="text-sm text-gray-400">Fecha de ingreso</p>
                <p class="text-lg">
                    {{ $empleado->fecha_ingreso ?? '---' }}
                </p>
            </div>

        </div>
    </section>

    </div>


    {{-- SECCIÓN: CAMBIO DE CONTRASEÑA --}}
    <div class="bg-gray-900 shadow border border-gray-700 rounded-xl p-6">
        <h3 class="text-xl font-semibold text-white mb-4">Seguridad de la Cuenta</h3>

        @include('profile.partials.update-password-form')
    </div>


    {{-- SECCIÓN (opcional): ELIMINAR CUENTA --}}
    {{-- Para admin normalmente se desactiva --}}
    {{-- @include('profile.partials.delete-user-form') --}}

</div>
@endsection
