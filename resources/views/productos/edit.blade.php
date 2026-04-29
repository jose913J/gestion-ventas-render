<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Producto</h1>
    <a href="{{ route('productos.index') }}" class="btn btn-secondary mb-3">Volver</a>

    <form action="{{ route('productos.update', $producto->id_producto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stock:</label>
            <input type="number" name="stock" value="{{ $producto->stock }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Categoría ID:</label>
            <input type="number" name="id_categoria" value="{{ $producto->id_categoria }}" class="form-control" placeholder="Opcional">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
    </form>
</div>
</body>
</html>
