@extends('layouts.app')

@section('title', 'Editar Venta')

@section('content')
    <div class="mb-3">
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">← Volver</a>
    </div>

    <h1>Editar Venta</h1>

    <form action="{{ route('ventas.update', $venta->id_venta) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label>Cliente:</label>
            <select name="id_cliente" class="form-control" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}" {{ $venta->id_cliente == $cliente->id_cliente ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label>Total:</label>
            <input type="number" step="0.01" name="total" value="{{ $venta->total }}" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label>Fecha:</label>
            <input type="datetime-local" name="fecha" value="{{ date('Y-m-d\TH:i', strtotime($venta->fecha)) }}" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar Venta</button>
    </form>
@endsection
