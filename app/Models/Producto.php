<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // Especifica el nombre exacto de la tabla
    protected $table = 'producto';
    
    // Especifica la clave primaria (si no se llama 'id')
    protected $primaryKey = 'id_producto';  // Ajusta según tu tabla
    
    // Los campos que se pueden llenar
    protected $fillable = [
        'nombre',
        'precio',
        'stock',
        'id_categoria'
    ];
    
    // Si tu tabla no tiene timestamps (created_at, updated_at)
    public $timestamps = false;
}
