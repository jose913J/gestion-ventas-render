<!DOCTYPE html>
<html>
<head>
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Cliente</h1>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary mb-3">Volver</a>

    <form action="{{ route('clientes.update', $cliente->id_cliente) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{ $cliente->nombre }}" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label>Teléfono:</label>
            <input type="text" name="telefono" value="{{ $cliente->telefono }}" class="form-control">
        </div>
        
        <div class="mb-3">
            <label>Dirección:</label>
            <textarea name="direccion" class="form-control" rows="3">{{ $cliente->direccion }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
    </form>
</div>
</body>
</html>
