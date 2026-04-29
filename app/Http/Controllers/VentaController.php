<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

    public function store(Request $request)
    {
        $items = json_decode($request->items, true);
        
        if(empty($items)) {
            return redirect()->back()->with('error', 'Agregue al menos un producto');
        }
        
        $total = 0;
        foreach($items as $item) {
            $total += $item['cantidad'] * $item['precio'];
        }
        
        $venta = Venta::create([
            'fecha' => now(),
            'total' => $total,
            'id_cliente' => $request->id_cliente,
            'id_empleado' => 1,
        ]);
        
        foreach($items as $item) {
            DetalleVenta::create([
                'id_venta' => $venta->id_venta,
                'id_producto' => $item['id'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio']
            ]);
        }
        
        return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente');
    }

    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.edit', compact('venta', 'clientes', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $venta = Venta::findOrFail($id);
        
        $request->validate([
            'id_cliente' => 'required',
            'total' => 'required|numeric',
            'fecha' => 'required'
        ]);
        
        $venta->update([
            'id_cliente' => $request->id_cliente,
            'total' => $request->total,
            'fecha' => $request->fecha
        ]);
        
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente');
    }

public function destroy($id)
{
    // Buscar la venta
    $venta = Venta::findOrFail($id);
    
    // Verificar si la tabla pago existe antes de intentar eliminar
    try {
        \DB::table('pago')->where('id_venta', $id)->delete();
    } catch (\Exception $e) {
        // Si la tabla no existe o está dañada, ignorar el error
    }
    
    // Eliminar los detalles de la venta
    \DB::table('detalle_venta')->where('id_venta', $id)->delete();
    
    // Finalmente eliminar la venta
    $venta->delete();
    
    return redirect()->route('ventas.index')
                     ->with('success', 'Venta eliminada exitosamente');
}
}

