@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Cliente</h1>
    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ $cliente->nombre }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" value="{{ $cliente->telefono }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $cliente->email }}" class="form-control" required>
        </div>
        <button class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection