@extends('layouts.app')

@section('title', 'Registrar Venta')

@section('content')
    <div class="mb-3">
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary">← Volver</a>
    </div>

    <h1>Registrar Nueva Venta</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('ventas.store') }}" method="POST" id="ventaForm">
        @csrf
        
        <div class="mb-3">
            <label>Cliente:</label>
            <select name="id_cliente" class="form-control" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Producto:</label>
                    <select id="producto_id" class="form-control">
                        <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id_producto }}" data-precio="{{ $producto->precio }}" data-nombre="{{ $producto->nombre }}">
                                {{ $producto->nombre }} - ${{ number_format($producto->precio, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label>Cantidad:</label>
                    <input type="number" id="cantidad" class="form-control" value="1" min="1">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label>&nbsp;</label>
                    <button type="button" id="agregar" class="btn btn-info form-control">Agregar Producto</button>
                </div>
            </div>
        </div>
        
        <table class="table table-bordered" id="tabla-productos">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tabla-body">
                <tr id="fila-vacia">
                    <td colspan="5" class="text-center">No hay productos agregados</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Total:</strong></td>
                    <td id="total">$0</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        
        <input type="hidden" name="items" id="items-hidden" value="[]">
        <button type="submit" class="btn btn-success" id="guardarVenta">Guardar Venta</button>
    </form>
@endsection

@section('scripts')
<script>
    let items = [];
    
    function actualizarTabla() {
        let html = '';
        let total = 0;
        
        if(items.length === 0) {
            html = '<tr id="fila-vacia"><td colspan="5" class="text-center">No hay productos agregados</td></tr>';
        } else {
            items.forEach((item, index) => {
                let subtotal = item.cantidad * item.precio;
                total += subtotal;
                html += `<tr>
                    <td>${item.nombre}</td>
                    <td>${item.cantidad}</td>
                    <td>$${item.precio}</td>
                    <td>$${subtotal.toFixed(2)}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarItem(${index})">Eliminar</button></td>
                </tr>`;
            });
        }
        
        document.getElementById('tabla-body').innerHTML = html;
        document.getElementById('total').innerText = '$' + total.toFixed(2);
        document.getElementById('items-hidden').value = JSON.stringify(items);
    }
    
    function eliminarItem(index) {
        items.splice(index, 1);
        actualizarTabla();
    }
    
    document.getElementById('agregar').addEventListener('click', function() {
        let select = document.getElementById('producto_id');
        let productoId = select.value;
        
        if(!productoId) {
            alert('Seleccione un producto');
            return;
        }
        
        let selectedOption = select.options[select.selectedIndex];
        let nombre = selectedOption.getAttribute('data-nombre');
        let precio = parseFloat(selectedOption.getAttribute('data-precio'));
        let cantidad = parseInt(document.getElementById('cantidad').value);
        
        if(cantidad < 1) {
            alert('La cantidad debe ser mayor a 0');
            return;
        }
        
        let existe = items.find(i => i.id == productoId);
        if(existe) {
            existe.cantidad += cantidad;
        } else {
            items.push({
                id: productoId,
                nombre: nombre,
                cantidad: cantidad,
                precio: precio
            });
        }
        
        actualizarTabla();
        
        // Resetear select y cantidad
        select.value = '';
        document.getElementById('cantidad').value = 1;
    });
    
    document.getElementById('ventaForm').addEventListener('submit', function(e) {
        if(items.length === 0) {
            e.preventDefault();
            alert('Agregue al menos un producto a la venta');
        }
    });
</script>
@endsection
