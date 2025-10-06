@extends('layouts.app')

@section('content')
<div class="container mt-4 text-white">
    <h1>Registrar Cliente</h1>

    <form action="{{ route('clientes.store') }}" method="POST" class="form-cliente">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" required>
        </div>

        <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-guardar">Guardar</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection
