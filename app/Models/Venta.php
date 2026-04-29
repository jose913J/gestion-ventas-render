<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'venta';
    
    // Clave primaria
    protected $primaryKey = 'id_venta';
    
    // Campos que se pueden llenar
    protected $fillable = [
        'fecha',
        'total',
        'id_cliente',
        'id_empleado'
    ];
    
    // Desactivar timestamps si tu tabla no tiene created_at/updated_at
    public $timestamps = false;
    
    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
    
    // Relación con DetalleVenta
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta', 'id_venta');
    }
}
