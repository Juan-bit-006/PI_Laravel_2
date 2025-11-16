<section>

    @php
        $empleado = Auth::user()->empleado ?? null;
    @endphp

    <div class="mt-6 space-y-6">

        {{-- Nombre del empleado (solo lectura) --}}
        <div>
            <x-input-label for="nombre_empleado" :value="__('Nombre del empleado')" />

            <x-text-input id="nombre_empleado" type="text" 
                class="mt-1 block w-full bg-gray-700 text-gray-300 cursor-not-allowed"
                value="{{ $empleado ? $empleado->nombre . ' ' . $empleado->apellido : 'Sin empleado asociado' }}"
                disabled />
        </div>

        {{-- Correo del login (solo lectura) --}}
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')" />

            <x-text-input id="email" type="email" 
                class="mt-1 block w-full bg-gray-700 text-gray-300 cursor-not-allowed"
                value="{{ Auth::user()->email }}"
                disabled />
        </div>

    </div>
</section>
