<section class="space-y-6 text-gray-100">
    <header>
        <h2 class="text-xl font-semibold text-red-400">Eliminar Cuenta</h2>
        <p class="mt-1 text-sm text-gray-400">
            Esta acción es permanente. Todos tus datos serán eliminados.
        </p>
    </header>

    {{-- Botón de abrir modal --}}
    <button
        x-data
        x-on:click="$dispatch('open-delete-modal')"
        class="bg-red-600 hover:bg-red-500 px-6 py-2 rounded-lg text-white font-semibold shadow-lg transition">
        Eliminar Cuenta
    </button>

    {{-- Modal --}}
    <div 
        x-data="{ open: false }"
        x-on:open-delete-modal.window="open = true"
        x-show="open"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50"
        x-cloak
    >
        <div class="bg-[#111827] border border-red-500/40 rounded-xl p-6 w-full max-w-md shadow-xl">
            
            <h2 class="text-lg font-bold text-red-400 mb-2">
                ¿Eliminar tu cuenta?
            </h2>

            <p class="text-sm text-gray-300 mb-4">
                Esta acción no se puede deshacer. Ingresa tu contraseña para confirmar.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('DELETE')

                <div>
                    <label class="block text-sm text-gray-300 mb-1">Contraseña</label>
                    <input 
                        type="password" 
                        name="password"
                        class="w-full bg-[#0f172a] border border-red-500/40 text-gray-100 rounded-lg px-4 py-2 focus:ring-red-400 focus:border-red-400"
                        placeholder="Ingresa tu contraseña"
                    >
                    @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 mt-4">
                    <button 
                        type="button"
                        x-on:click="open = false"
                        class="px-5 py-2 rounded-lg bg-gray-700 text-gray-200 hover:bg-gray-600 transition">
                        Cancelar
                    </button>

                    <button 
                        type="submit"
                        class="px-5 py-2 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-500 transition shadow-lg">
                        Eliminar Definitivamente
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
