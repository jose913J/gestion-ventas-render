@extends('layouts.app')

@section('title', 'Listado de Ventas')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Listado de Ventas</h1>
        <a href="{{ route('ventas.create') }}" class="btn btn-primary">Nueva Venta</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->id_venta }}</td>
                <td>{{ $venta->fecha }}</td>
                <td>{{ $venta->cliente->nombre ?? 'N/A' }}</td>
                <td>${{ number_format($venta->total, 2) }}</td>
                <td>
                    <a href="{{ route('ventas.edit', $venta->id_venta) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('ventas.destroy', $venta->id_venta) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta venta?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

