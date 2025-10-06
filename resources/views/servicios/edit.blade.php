@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
	<div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-8">
		<h1 class="text-2xl font-bold text-blue-700 mb-6">Editar Servicio</h1>
		<form action="{{ route('servicios.update', $servicio->id) }}" method="POST">
			@csrf
			@method('PUT')
			<div class="mb-4">
				<label class="block text-gray-700 font-bold mb-2" for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('nombre', $servicio->nombre) }}" required>
				@error('nombre')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
			</div>
			<div class="mb-4">
				<label class="block text-gray-700 font-bold mb-2" for="descripcion">Descripción</label>
				<textarea name="descripcion" id="descripcion" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('descripcion', $servicio->descripcion) }}</textarea>
				@error('descripcion')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
			</div>
			<div class="mb-4">
				<label class="block text-gray-700 font-bold mb-2" for="precio">Precio</label>
				<input type="number" step="0.01" name="precio" id="precio" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('precio', $servicio->precio) }}" required>
				@error('precio')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
			</div>
			<div class="mb-6">
				<label class="block text-gray-700 font-bold mb-2" for="duracion">Duración (minutos)</label>
				<input type="number" name="duracion" id="duracion" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('duracion', $servicio->duracion) }}" required>
				@error('duracion')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
			</div>
			<div class="flex justify-between">
				<a href="{{ route('servicios.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Cancelar</a>
				<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar</button>
			</div>
		</form>
	</div>
</div>
@endsection
