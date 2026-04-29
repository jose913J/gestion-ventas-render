<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = 'detalle_venta';
    protected $primaryKey = 'id_detalle';
    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'precio_unitario'
    ];
    public $timestamps = false;
    
    // Relación con Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
    }
    
    // Relación con Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
