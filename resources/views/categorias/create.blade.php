@extends('layouts.app')

@section('title', 'Crear Categoría')

@section('content')
    <div class="mb-3">
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">← Volver</a>
    </div>

    <h1>Crear Nueva Categoría</h1>

    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Guardar Categoría</button>
    </form>
@endsection

