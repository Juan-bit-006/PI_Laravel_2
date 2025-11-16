<section>
    <header>
        <p class="mt-1 text-sm text-gray-400">
            Actualizar Contraseña
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Contraseña Actual --}}
        <div>
            <x-input-label for="current_password" :value="__('Contraseña Actual')" class="text-gray-300" />

            <input id="current_password" name="current_password" type="password"
                class="mt-1 block w-full bg-[#0f1629] border border-yellow-600/30 text-gray-200
                       focus:border-yellow-500 focus:ring-yellow-500 rounded-lg"
                autocomplete="current-password" />
        </div>

        {{-- Nueva Contraseña --}}
        <div>
            <x-input-label for="password" :value="__('Nueva Contraseña')" class="text-gray-300" />

            <input id="password" name="password" type="password"
                class="mt-1 block w-full bg-[#0f1629] border border-yellow-600/30 text-gray-200
                       focus:border-yellow-500 focus:ring-yellow-500 rounded-lg"
                autocomplete="new-password" />
        </div>

        {{-- Confirmar Contraseña --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-gray-300" />

            <input id="password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full bg-[#0f1629] border border-yellow-600/30 text-gray-200
                       focus:border-yellow-500 focus:ring-yellow-500 rounded-lg"
                autocomplete="new-password" />
        </div>

        {{-- Botón --}}
        <div class="flex items-center gap-4">
            <button class="bg-yellow-600 hover:bg-yellow-700 text-black font-semibold px-4 py-2 rounded-lg">
                Guardar Contraseña
            </button>

            @if (session('status') === 'password-updated')
                <p class="text-sm text-green-400">Contraseña actualizada correctamente.</p>
            @endif
        </div>
    </form>
</section>
