@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
	<div class="flex justify-between items-center mb-6">
		<h1 class="text-3xl font-bold text-blue-700">Servicios</h1>
		<a href="{{ route('servicios.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Nuevo Servicio</a>
	</div>
	@if(session('success'))
		<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
			{{ session('success') }}
		</div>
	@endif
	<div class="overflow-x-auto">
		<table class="min-w-full bg-white rounded-lg shadow">
			<thead class="bg-blue-100">
				<tr>
					<th class="py-2 px-4">ID</th>
					<th class="py-2 px-4">Nombre</th>
					<th class="py-2 px-4">Descripción</th>
					<th class="py-2 px-4">Precio</th>
					<th class="py-2 px-4">Duración (min)</th>
					<th class="py-2 px-4">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($servicios as $servicio)
				<tr class="border-b hover:bg-blue-50">
					<td class="py-2 px-4">{{ $servicio->id }}</td>
					<td class="py-2 px-4">{{ $servicio->nombre }}</td>
					<td class="py-2 px-4">{{ $servicio->descripcion }}</td>
					<td class="py-2 px-4">${{ number_format($servicio->precio, 2) }}</td>
					<td class="py-2 px-4">{{ $servicio->duracion }}</td>
					<td class="py-2 px-4 flex space-x-2">
						<a href="{{ route('servicios.edit', $servicio->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">Editar</a>
						<form action="{{ route('servicios.destroy', $servicio->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este servicio?');">
							@csrf
							@method('DELETE')
							<button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded">Eliminar</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
