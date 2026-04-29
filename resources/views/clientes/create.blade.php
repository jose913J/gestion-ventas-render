<!DOCTYPE html>
<html>
<head>
    <title>Crear Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Crear Nuevo Cliente</h1>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary mb-3">Volver</a>

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label>Teléfono:</label>
            <input type="text" name="telefono" class="form-control" placeholder="Opcional">
        </div>
        
        <div class="mb-3">
            <label>Dirección:</label>
            <textarea name="direccion" class="form-control" rows="3" placeholder="Opcional"></textarea>
        </div>
        
        <button type="submit" class="btn btn-success">Guardar Cliente</button>
    </form>
</div>
</body>
</html>
