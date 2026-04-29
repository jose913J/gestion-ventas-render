@extends('layouts.app')

@section('title', 'Listado de Categorías')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Listado de Categorías</h1>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">Nueva Categoría</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id_categoria }}</td>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->descripcion ?? '-' }}</td>
                <td>
                    <a href="{{ route('categorias.edit', $categoria->id_categoria) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('categorias.destroy', $categoria->id_categoria) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

