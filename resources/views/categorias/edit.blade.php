@extends('layouts.app')

@section('title', 'Editar Categoría')

@section('content')
    <div class="mb-3">
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">← Volver</a>
    </div>

    <h1>Editar Categoría</h1>

    <form action="{{ route('categorias.update', $categoria->id_categoria) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{ $categoria->nombre }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control">{{ $categoria->descripcion }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Categoría</button>
    </form>
@endsection
