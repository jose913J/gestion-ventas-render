<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Listado de Clientes</h1>
    
    <!-- Menú de navegación entre módulos -->
    <div class="mb-3">
        <a href="{{ route('productos.index') }}" class="btn btn-info">Productos</a>
        <a href="{{ route('categorias.index') }}" class="btn btn-info">Categorías</a>
        <a href="{{ route('clientes.index') }}" class="btn btn-primary">Clientes</a>
        <a href="{{ route('ventas.index') }}" class="btn btn-success">Ventas</a>
    </div>
    
    <a href="{{ route('clientes.create') }}" class="btn btn-primary mb-3">Nuevo Cliente</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id_cliente }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->telefono ?? '-' }}</td>
                <td>{{ $cliente->direccion ?? '-' }}</td>
                <td>
                    <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este cliente?')">Eliminar</button>
                    </form>
                 </td>
            </tr>
            @endforeach
        </tbody>
     </table>
</div>
</body>
</html>
